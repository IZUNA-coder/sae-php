<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>
<body>
   

<?php 
echo "<h1>Bonjour {$_SESSION["prenom"]} </h1>";
if(isset($_SESSION["userRegister"])){
    echo "<h2>User Vient de S'incrire  {$_SESSION["userRegister"]}</h2>";
    var_dump($_SESSION["userRegister"]);
}
echo $form ?? null; 

if($_SESSION["id_role"] == 1){
    echo "<section>";
    echo $formAdminAlbum ?? null;
    echo "</section>";
    
    echo "<section>";
    echo $formAdminArtiste ?? null;
    echo "</section>";
 

}

if($_SESSION["id_role"] == 2){
    if (isset($_SESSION['added_album_id'])) {
        $added_album_id = $_SESSION['added_album_id'];
        echo "The ID of the deleted album is: " . $added_album_id;
    }
    
    var_dump($_SESSION);  
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
}

?>



</body>
</html>