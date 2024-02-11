<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chanson</title>
</head>
<body>
    <H1>ETHIBFOHIBN</H1>

    <?php

    echo $form ?? null;
    
    echo '<br>';
   
    echo "ID Album: " . $albumbyid->idalbum . "<br>";
    echo "Nom Album: " . $albumbyid->nom_album . "<br>";
    echo "Annee Album: " . $albumbyid->annee_album . "<br>";
    echo "ID Artiste: " . $albumbyid->idartiste . "<br>";
    echo "Image Album: " . $albumbyid->image_album . "<br>";
    echo "<img src=".$albumbyid->image_album." alt='image album'>";
    echo '<br>';
    echo '<br>';

    foreach($artistes as $artiste){
        if ($artiste['idartiste'] == $albumbyid->idartiste) {
            echo "<h4>Artiste: {$artiste['prenom_artiste']} {$artiste['nom_artiste']}</h4>";
            break;  
        }
    }
    echo '<br>';

    echo "<div style='font-family: Arial, sans-serif;'>";

foreach($chansonsbyid as $chansonbyid) {        
    foreach($chansons as $chanson) {
        if ($chanson['idchanson'] == $chansonbyid->idchanson) {
            echo "<p><strong>Nom Chanson:</strong> " . $chanson['nom_chanson'] . "</p>";
            echo "<p><strong>Duree Chanson:</strong> " . $chanson['duree_chanson'] . "</p>";
            echo "<hr>";
        }
    }
}
echo "</div>";
?>

</body>
</html>