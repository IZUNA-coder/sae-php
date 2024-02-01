<?php

try{

    if (file_exists('sound.sqlite3')) {
        unlink('sound.sqlite3');
    }
    

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
            id_playlist INTEGER NOT NULL,
            nomplaylist TEXT,
            idutilisateur NOT NULL,
            PRIMARY KEY (id_playlist, idutilisateur)
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

        $db->exec("INSERT INTO ROLE (id_role, nom_role) VALUES (1, 'admin')");
    $db->exec("INSERT INTO ROLE (id_role, nom_role) VALUES (2, 'utilisateur')");


         // Insert into UTILISATEUR table
    $db->exec("INSERT INTO UTILISATEUR (pseudo, nom, prenom, email, mdp, id_role) VALUES
    ('JM', 'JM', 'JM', 'JM@gmail.com', 'JM', 2),
    ('admin', 'admin', 'Super', 'admin@gmail.com', 'admin', 1)");


     // Insert into ARTISTE table
     $db->exec("INSERT INTO ARTISTE (pseudo_artiste, nom_artiste, prenom_artiste) VALUES
     ('john_doe', 'Doe', 'John'),
     ('jane_smith', 'Smith', 'Jane')");

// Insert into ALBUM table
$db->exec("INSERT INTO ALBUM (nom_album, annee_album, image_album, idartiste) VALUES
     ('Album1', '2022', './fixtures/images/Terry_Allen_Pedal_Steal.jpg', 1),
     ('Album2', '2023', './fixtures/images/Terry_Allen_Pedal_Steal.jpg', 2)");

// Insert into GENRE table
$db->exec("INSERT INTO GENRE (nomgenre) VALUES
     ('Pop'),
     ('Rock')");

// Insert into CHANSON table
$db->exec("INSERT INTO CHANSON (nom_chanson, duree_chanson) VALUES
     ('Song1', '00:04:30'),
     ('Song2', '00:03:45')");

// Insert into CHANTER table
$db->exec("INSERT INTO CHANTER (idchanson, idartiste) VALUES
     (1, 1),
     (2, 2)");

// Insert into CONTENIR_ALBUM table
$db->exec("INSERT INTO CONTENIR_ALBUM (idalbum, idchanson) VALUES
     (1, 1),
     (1, 2),
     (2, 2)");

// Insert into PLAYLIST table
$db->exec("INSERT INTO PLAYLIST (id_playlist, nomplaylist, idutilisateur) VALUES
     (1, 'MyPlaylist', 1),
     (2, 'WorkoutSongs', 2)");


}}

catch(PDOException $e){
    echo $e->getMessage().PHP_EOL;
    exit;
}
?>