<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums</title>
    <link rel="stylesheet" href="../static/css/albumAdmin.css">
    <link rel="stylesheet" href="../static/css/accueiluser.css">

</head>
<body>
  

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

?>

<?php 



$formAdd = $this->getFormAddAdmin(1);
echo $formAdd ?? null;

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
        

        
        if ($album['image_album'] == 1 || !preg_match('/^\.\/data\//', $album['image_album'])) {
            echo "<td><img src=\"./data/images/default2.jpg\" width=\"100px\"></td>";
        } else {
            echo "<td><img src=\"{$album['image_album']}\" width=\"100px\"></td>";
        }

        
        $genre = $dbAlbum->getGenreAlbumbyId($album["idalbum"]);

            $genreString = '';
            for ($i = 0; $i < count($genre); $i++) {
                $genreString .= $genre[$i]['nom_genre'];
                if ($i < count($genre) - 1) {
                    $genreString .= ', ';
                }
            }

            echo "<td>{$genreString}</td>";
  
        echo '<td>';
        
            
        $formDelete = $this->getFormDeleteAdmin($album['idalbum']);
        $formAdd = $this->getFormAddAdmin($album['idalbum']);
        $formModifier = $this->getFormLink($album['idalbum']);
        echo $formDelete ?? null;    
        echo $formModifier;
       

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