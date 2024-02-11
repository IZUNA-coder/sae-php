<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musique</title>
</head>
<body>
   

<?php 
echo "<h1>Bonjour {$_SESSION["prenom"]} </h1>";


echo $form ?? null; 
foreach($albums as $album){
    echo "<h2> {$album['nom_album']}</h2>";
    echo "<h3> {$album['annee_album']}</h3>";
    echo "<img src='{$album['image_album']}' width='100px'>";
    echo "<br>";   
 
    foreach($artistes as $artiste){
        if ($artiste['idartiste'] == $album['idartiste']) {
            echo $formLinks[$artiste['idartiste']] ?? null;
            echo "<h4> {$artiste['prenom_artiste']} {$artiste['nom_artiste']}</h4>";
            break;  
        }
    } 
}
?>

<footer>
    <p>information dans le footer</p>
</footer>

</body>
</html>