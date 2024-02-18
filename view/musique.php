<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/banniere.css">
    <link rel="stylesheet" href="../static/css/albumAdmin.css">
    <title>Chanson</title>
</head>
<body>
    <H1>Musique de l'Album</H1>
    <?php include 'banniere.php'; ?>
    <?php
    echo $formRetour ?? null;
    echo "<section>";
    echo "<p><strong>Date de Sortie:</strong> " . $albumbyid->annee_album . "<p>";
    echo "<img src=".$albumbyid->image_album." alt='image album'>";
    echo "<h2>Album</h2>";
    echo "<h3>".$albumbyid->nom_album."</h3>";  
    echo "</section>";
    
    echo "<br>";
    echo "<br>";
    echo "<br>";

    $_SESSION["idPage"] = $albumbyid->idalbum;
    foreach($artistes as $artiste){
        if ($artiste['idartiste'] == $albumbyid->idartiste) {
            echo "<h4>Artiste: {$artiste['prenom_artiste']} {$artiste['nom_artiste']}</h4>";
            break;  
        }
    }
    echo "<div style='font-family: Arial, sans-serif;'>";
foreach($chansonsbyid as $chansonbyid) {        
    foreach($chansons as $chanson) {
        if ($chanson['idchanson'] == $chansonbyid->idchanson) {
            echo "<p><strong>Nom Chanson:</strong> " . $chanson['nom_chanson'] . "</p>";
            echo "<p><strong>Duree Chanson:</strong> " . $chanson['duree_chanson'] . "</p>";
            echo "<p><strong>Genre Chanson:</strong> " . $chanson['genre_chanson'] . "</p>";
            
            $_SESSION['id_chanson'] = $chanson['idchanson'];
            echo '<br>';
            echo '<br>';
            $formAjout = $this->getFormAjout($chanson['idchanson']);
            $_SESSION["idchansonAjout"] = $chanson['idchanson'];
            
            echo $formAjout ?? null;
            echo "<hr>";
            
            echo '<br>';
            echo '<br>';
            echo '<br>';
           
            break;
        }
    }
}
echo "</div>";
?>



</body>
</html>