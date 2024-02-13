<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums</title>
    
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





//foreach($albums as $album){  
// 
//    foreach($artistes as $artiste){
//        if ($artiste['idartiste'] == $album['idartiste']) {
//            echo $formLinks[$artiste['idartiste']] ?? null;
//            echo "<h4> {$artiste['prenom_artiste']} {$artiste['nom_artiste']}</h4>";
//            break;  
//        }
//    } 
//}

?>

<?php 
if($albums ?? null && !empty($albums)){
    echo "<h2>Albums</h2>";
    echo "<table class='tab-groupes'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Nom</th>";
    echo "<th>Année</th>";
    echo "<th>Image</th>";
    echo "<th>Genre</th>";
    echo "<th>Modification</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach($albums as $album){ 
        echo '<tr>';
        echo "<td> {$album['idalbum']}</td>";
        echo "<td>{$album['nom_album']}</td>";
        echo "<td>{$album['annee_album']}</td>";
        echo "<td><img src=\"{$album['image_album']}\" width=\"100px\"></td>";
        echo '<td> Fonction à faire </td>';
        echo '<td>';
        
            //echo $formAdminAjout ?? null;
            foreach($albumsbyid as $albumbyid) {
                if ($albumbyid["idalbum"] == $album['idalbum']) {
                    $formDelete = $this->getFormDelete($albumbyid["idalbum"]);
                    echo $formDelete ?? null;
                    var_dump($formDelete);
                    break;  
                }
            }
        echo '</td>';
        echo '</tr>';
        
    }
    echo "</tbody>";
    echo "</table>";
}else{
    echo "<h2>Albums</h2>";
    echo "<p>Il n'y a pas d'albums</p>";
}
?>
</body>
</html>