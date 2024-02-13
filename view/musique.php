<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chanson</title>
    <script defer>
   window.onload = function() {
    let inputFields = document.querySelectorAll("#album_id");
    inputFields.forEach((inputField, index) => {
        if(inputField){
        console.log(`Input field ${index + 1}:`, inputField.value);
        }else{
            console.log("Input field not found");
        }
    });
};
</script>
</head>
<body>
    <H1>Musique Album</H1>

    <?php

    use Auth\DBPlaylist;

    //echo $formRetour ?? null;
    
    echo '<br>';
    echo "<h1>ID USER : {$_SESSION["auth"]}</h1>";
    echo '<br>';
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
            echo "<p><strong>ID Chanson:</strong> " . $chanson['idchanson'] . "</p>";
            echo "<p><strong>Nom Chanson:</strong> " . $chanson['nom_chanson'] . "</p>";
            echo "<p><strong>Duree Chanson:</strong> " . $chanson['duree_chanson'] . "</p>";
            $_SESSION['id_chanson'] = $chanson['idchanson'];
            echo '<br>';
            echo '<br>';
            echo "<h3>ID Chanson: {$chanson['idchanson']} </h3>";
            var_dump($chanson['idchanson']);
            $formAjout = $this->getFormAjout($chanson['idchanson']);
            $_SESSION["idchansonAjout"] = $chanson['idchanson'];
            echo $formAjout ?? null;
            var_dump($formAjout);
            echo "<hr>";
            
            echo '<br>';
            echo "Playlist:";
            echo '<br>';
            echo '<br>';
            echo "tes";
            echo '<br>';
            echo '<br>';
           
            break;
        }
    }
}
echo "</div>";

echo "id Chanson: ";
var_dump($_SESSION["idchansonAjout"]);
?>



</body>
</html>