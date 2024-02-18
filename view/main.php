<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/accueilAdmin.css">
    <link rel="stylesheet" href="../static/css/banniere.css">
    <title>Accueil</title>
</head>
<body>
<?php include 'banniere.php'; ?>
<?php 
echo "<h1>Bienvenue {$_SESSION["prenom"]} </h1>";
echo $formRetour ?? null; 

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
        echo "<h2> {$album['nom_album']}</h2>";
        echo "<h3> {$album['annee_album']}</h3>";
        echo "<img src='{$album['image_album']}' width='100px'>";
        echo "<br>";   
    
        foreach($artistes as $artiste){
            if ($artiste['idartiste'] == $album['idartiste']) {
                echo $formLinks[$artiste['idartiste']] ?? null;
                echo "<h4> {$artiste['prenom_artiste']} {$artiste['nom_artiste']}</h4>";
                $_SESSION["idPage{$artiste['idartiste']}"] = $artiste['idartiste'];
                break;  
            }
        } 
    }
}

?>



</body>
</html>