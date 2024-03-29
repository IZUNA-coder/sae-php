<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;


try {

    $cheminFichier = "data/extrait.yml";
    $contenuFichier = Yaml::parseFile($cheminFichier);

    if (!file_exists('sound.sqlite3')) {

        $db = new PDO('sqlite:sound.sqlite3');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $db->exec("CREATE TABLE ARTISTE(
            idartiste INTEGER PRIMARY KEY ,
            pseudo_artiste TEXT,
            nom_artiste    TEXT,
            prenom_artiste TEXT
        )");


        $db->exec("CREATE TABLE IF NOT EXISTS ALBUM (
        idalbum INTEGER PRIMARY KEY, 
        nom_album TEXT, 
        annee_album TEXT,
        image_album TEXT,
        idartiste TEXT,
        FOREIGN KEY (idartiste) REFERENCES ARTISTE(id)
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS APPARTENIR_ALBUM (
            idalbum INTEGER NOT NULL,
            idgenre INTEGER NOT NULL,
            PRIMARY KEY (idalbum, idgenre),
            FOREIGN KEY (idalbum) REFERENCES ALBUM(idalbum),
            FOREIGN KEY (idgenre) REFERENCES GENRE(idgenre)
        )");



        $db->exec("CREATE TABLE IF NOT EXISTS CHANSON (
            idchanson INTEGER PRIMARY KEY,
            nom_chanson TEXT,
            duree_chanson DATE
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS GENRE (
            idgenre INTEGER PRIMARY KEY,
            nomgenre TEXT
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS CHANTER (
            idchanson INTEGER NOT NULL,
            idartiste INTEGER NOT NULL,
            PRIMARY KEY (idchanson, idartiste),
            FOREIGN KEY (idartiste) REFERENCES ARTISTE(idartiste)
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS CONTENIR (
            id_playlist INTEGER NOT NULL,
            idchanson INTEGER NOT NULL,
            FOREIGN KEY (idchanson) REFERENCES CHANSON (idchanson),
            FOREIGN KEY (id_playlist) REFERENCES PLAYLIST (id_playlist)
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS CONTENIR_ALBUM (
            idalbum INTEGER NOT NULL,
            idchanson INTEGER NOT NULL,
            PRIMARY KEY (idalbum, idchanson),
            FOREIGN KEY (idchanson) REFERENCES CHANSON (idchanson),
            FOREIGN KEY (idalbum) REFERENCES ALBUM (idalbum)
        )");



        $db->exec("CREATE TABLE IF NOT EXISTS NOTER (
            idalbum INTEGER NOT NULL,
            idutilisateur INTEGER NOT NULL,
            note INTEGER,
            PRIMARY KEY (idalbum, idutilisateur),
            FOREIGN KEY (idalbum) REFERENCES ALBUM (idalbum),
            FOREIGN KEY (idutilisateur) REFERENCES UTILISATEUR (idutilisateur)
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS PLAYLIST (
            id_playlist INTEGER PRIMARY KEY AUTOINCREMENT,
            nomplaylist TEXT,
            idutilisateur INTEGER NOT NULL,
            FOREIGN KEY (idutilisateur) REFERENCES UTILISATEUR (idutilisateur)
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS PRODUCTEUR (
            idproducteur INTEGER PRIMARY KEY,
            nom_producteur TEXT,
            prenom_producteur TEXT
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS PRODUIRE (
            idproducteur INTEGER NOT NULL,
            idchanson INTEGER NOT NULL,
            FOREIGN KEY (idproducteur) REFERENCES PRODUCTEUR (idproducteur),
            FOREIGN KEY (idchanson) REFERENCES CHANSON (idchanson)
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS ROLE (
            id_role INTEGER PRIMARY KEY,
            nom_role TEXT
        )");

        $db->exec("CREATE TABLE IF NOT EXISTS UTILISATEUR (
            idutilisateur INTEGER PRIMARY KEY,
            pseudo TEXT,
            nom TEXT,
            prenom TEXT,
            email TEXT,
            mdp TEXT,
            id_role INTEGER,
            FOREIGN KEY (id_role) REFERENCES ROLE (id_role)
        )");

        $test = $db->prepare("SELECT * FROM UTILISATEUR WHERE pseudo = 'admin' AND mdp = 'admin'");
        $row = $test->fetch(PDO::FETCH_OBJ);
        if ($row && $row->mdp == "admin") {
            // Do something
        }

        $db->exec("INSERT INTO ROLE (id_role, nom_role) VALUES (1, 'admin')");
        $db->exec("INSERT INTO ROLE (id_role, nom_role) VALUES (2, 'utilisateur')");


        // Insert into UTILISATEUR table
        $db->exec("INSERT INTO UTILISATEUR (pseudo, nom, prenom, email, mdp, id_role) VALUES
    ('user', 'user', 'user', 'user@gmail.com', 'user', 2),
    ('admin', 'admin', 'Super', 'admin@gmail.com', 'admin', 1)");



        // Insert into PLAYLIST table
        $db->exec("INSERT INTO PLAYLIST (id_playlist, nomplaylist, idutilisateur) VALUES
     (1, 'MyPlaylist', 1),
     (2, 'WorkoutSongs', 2)");

       
        // Insert into Chanson table
        $db->exec("INSERT INTO CHANSON (idchanson, nom_chanson, duree_chanson) VALUES
        (1,'Whitey''s Theme', '6:00'),
        (2,'My Prayer', '4:00'),
        (3,'Señorita', '3:00'),
        (4,'I''m a Believer', '2:00'),
        (5,'DURE CETTE SAE', '2:00'),
        (6,'CHAUD MONSIEUR', '2:00')");
        

        // Insert into ChANTER table
        $db->exec("INSERT INTO CHANTER (idchanson, idartiste) VALUES
        (1, 1),
        (2, 1),
        (3, 1),
        (4, 1),
        (5, 1),
        (6, 1)");

        // Insert into CONTENIR_ALBUM table
        $db->exec("INSERT INTO CONTENIR_ALBUM (idalbum, idchanson) VALUES
        (1, 1),
        (1, 2),
        (1, 3),
        (2, 4),
        (2, 5),
        (3, 6)");
        foreach ($contenuFichier as $albumData) {
            $artistName = $albumData['by'];
            $albumTitle = $albumData['title'];
            $releaseYear = $albumData['releaseYear'];
            $genres = $albumData['genre'];

            $img = $albumData['img'];
            if($img == null){
                $img = "./data/images/" . "default.jpg";
            }
            else{
                $img = "./data/images/" . $albumData['img'];
            }
            $requeteArtiste = $db->query("SELECT * FROM ARTISTE WHERE pseudo_artiste = '$artistName'");
            $artiste = $requeteArtiste->fetch(PDO::FETCH_ASSOC);
            if (!$artiste) {
                $db->exec("INSERT INTO ARTISTE (pseudo_artiste, nom_artiste, prenom_artiste) VALUES ('$artistName', '', '')");
                $idArtiste = $db->lastInsertId();
            } else {
                $idArtiste = $artiste['idartiste'];
            }
            $db->exec("INSERT INTO ALBUM (nom_album, annee_album, image_album, idartiste) 
               VALUES ('$albumTitle', '$releaseYear', '$img', '$idArtiste')");
            $idAlbum = $db->lastInsertId();

            foreach ($genres as $genre) {
                $genreUpperCase = strtoupper($genre);
                $requeteGenre = $db->query("SELECT * FROM GENRE WHERE nomgenre = '$genreUpperCase'");
                $presentGenre = $requeteGenre->fetch(PDO::FETCH_ASSOC);
                if (!$presentGenre) {
                    $db->exec("INSERT INTO GENRE (nomgenre) VALUES ('$genreUpperCase')");
                    $idGenre = $db->lastInsertId();
                } else {
                    $idGenre = $presentGenre['idgenre'];
                }
            }

            foreach ($genres as $genre) {
                $genreUpperCase = strtoupper($genre);
                $requeteGenre = $db->query("SELECT idgenre FROM GENRE WHERE nomgenre = '$genreUpperCase'");
                $genreResult = $requeteGenre->fetch(PDO::FETCH_ASSOC);
                $idg = $genreResult['idgenre'];
                $db->exec("INSERT INTO APPARTENIR_ALBUM (idalbum, idgenre) VALUES ('$idAlbum', '$idg')");
            }           
            
        }
    }
} catch (PDOException $e) {
    echo $e->getMessage() . PHP_EOL;
    exit;
}
