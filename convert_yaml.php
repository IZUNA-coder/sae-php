<?php
require_once 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

try {
    $cheminFichier = "fixtures/extrait.yml";
    $contenuFichier = Yaml::parseFile($cheminFichier);

    $db = new PDO('sqlite:sound.sqlite3');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach ($contenuFichier as $albumData) {
        $artistName = $albumData['by'];
        $albumTitle = $albumData['title'];
        $releaseYear = $albumData['releaseYear'];
        $genre = implode(", ", $albumData['genre']);
        $img = $albumData['img'];

        $db->exec("INSERT INTO ARTISTE (pseudo_artiste, nom_artiste, prenom_artiste) VALUES ('$artistName', '', '')");
        $idArtiste = $db->lastInsertId();

        $db->exec("INSERT INTO ALBUM (nom_album, annee_album, image_album, idartiste) 
                   VALUES ('$albumTitle', '$releaseYear', '$img', '$idArtiste')");
        $idAlbum = $db->lastInsertId();

        $db->exec("INSERT INTO GENRE (nomgenre) VALUES ('$genre')");
        $idGenre = $db->lastInsertId();

        $db->exec("INSERT INTO APPARTENIR_ALBUM (idalbum, idgenre) VALUES ('$idAlbum', '$idGenre')");
    }

    echo "Insertions réussies!";
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
