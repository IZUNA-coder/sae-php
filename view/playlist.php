<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>playlist</title>
    <link rel="stylesheet" href="../static/css/banniere.css">
    <link rel="stylesheet" href="../static/css/accueiluser.css">
</head>
<body>
    <?php


    echo $formRetour ?? null;


// Afficher chaque playlist
    echo "<div class='{$playlist[0]['nomplaylist']}'>";
    echo "<h1> {$playlist[0]['nomplaylist']}</h2>";
    echo "<br>";   
  
    // Afficher les chansons de la playlist

    $songs = $dbPlaylist->getPlaylistSongs($playlist[0]['id_playlist']);
    if($songs == null){
        echo "<h3> Aucune chanson dans cette playlist</h3>";
    }else{
        foreach($songs as $song){
            echo "<h3> {$song["nom_chanson"]}</h3>";
            echo "<h4> {$song["duree_chanson"]} min</h4>";
            $formDelete = $this->getFormChanson($song["idchanson"]);
            echo $formDelete ?? null;
        
        
        }
    }

    echo "</div>";


?>
    
    
</body>
</html>