<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
<script src="../static/js/filtre.js" defer></script>


    <link rel="stylesheet" href="../static/css/accueilAdmin.css">
    <link rel="stylesheet" href="../static/css/banniere.css">
    <link rel="stylesheet" href="../static/css/accueiluser.css">
</head>
<body>
<?php include 'banniere.php'; ?>
<?php 
echo "<h1>Bienvenue {$_SESSION["prenom"]} </h1>";
echo $formRetour ?? null; 
echo $formRecherche ?? null;
echo $formPlaylist ?? null;

echo $selectGenre ?? null;
echo $selectAnnee ?? null;
echo $selectArtiste ?? null;


if($_SESSION["id_role"] == 1){
    echo "<section>";
    echo $formAdminAlbum ?? null;
    echo "</section>";
    
    echo "<section>";
    echo $formAdminArtiste ?? null;
    echo "</section>";
 

}

if($_SESSION["id_role"] == 2){
     
    foreach($albums as $album){
        echo "<div class='{$album['nom_album']}'>";
        echo "<h2> {$album['nom_album']}</h2>";
        echo "<h3> {$album['annee_album']}</h3>";
        echo "<img src='{$album['image_album']}' width='100px'>";
        echo "<br>";   
        $genre = $dbAlbum->getGenreAlbumbyId($album['idalbum']);
        $genreString = '';

        for ($i = 0; $i < count($genre); $i++) {
            $genreString .= $genre[$i]['nom_genre'];
            if ($i < count($genre) - 1) {
                $genreString .= ', ';
            }
        }
        echo "<h4 id={$genreString}> Genre: {$genreString}</h4>";
        
        foreach($artistes as $artiste){
            
            if ($artiste['idartiste'] == $album['idartiste']) {
                echo "<h5> {$artiste['pseudo_artiste']}</h5>";
                echo $formLinks[$album['idalbum']] ?? null;

                $_SESSION["idPage{$artiste['idartiste']}"] = $artiste['idartiste'];
                echo "</div>";
                break;  
            }
        } 
    }
}

?>



</body>
</html>