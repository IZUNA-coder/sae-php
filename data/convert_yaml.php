<?php
require_once __DIR__  . '/../packages/vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

try {
    $cheminFichier = __DIR__ . "/extrait.yml";
    $contenuFichier = Yaml::parseFile($cheminFichier);

    $db = new PDO('sqlite:sound.sqlite3');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ($contenuFichier as $albumData) {
        $artistName = $albumData['by'];
        $albumTitle = $albumData['title'];
        $releaseYear = $albumData['releaseYear'];
        $genres = $albumData['genre'];
        $img = "./data/images/" . $albumData['img'];
        $requeteArtiste = $db->query("SELECT * FROM ARTISTE WHERE pseudo_artiste = '$artistName'");
        $artiste = $requeteArtiste-> fetch(PDO::FETCH_ASSOC);
        if(!$artiste){
            $db->exec("INSERT INTO ARTISTE (pseudo_artiste, nom_artiste, prenom_artiste) VALUES ('$artistName', '', '')");
            $idArtiste = $db->lastInsertId();
        }
        else{
            $idArtiste = $artiste['idartiste'];
        }
        $db->exec("INSERT INTO ALBUM (nom_album, annee_album, image_album, idartiste) 
                   VALUES ('$albumTitle', '$releaseYear', '$img', '$idArtiste')");
        $idAlbum = $db->lastInsertId();

        foreach($genres as $genre){
            $requeteGenre = $db->query("SELECT * FROM GENRE WHERE nomgenre = '$genre'");
            $presentGenre = $requeteGenre-> fetch(PDO::FETCH_ASSOC);
            if(!$presentGenre){
                $db->exec("INSERT INTO GENRE (nomgenre) VALUES ('$genre')");
                $idGenre = $db->lastInsertId();
            }
            else{
                $idGenre = $presentGenre['idgenre'];
            }
        }
        $db->exec("INSERT INTO APPARTENIR_ALBUM (idalbum, idgenre) VALUES ('$idAlbum', '$idGenre')");
    }

    echo "Insertions réussies!";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
