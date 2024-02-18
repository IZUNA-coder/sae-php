<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums</title>

<style>
    
:root{
    --couleur1: #fff;
    --couleur2:rgb(80,70,180);
    --couleur3: rgb(181, 187, 199);
    --couleur4: rgb(235, 236, 236);
}

*{
    font-family: 'Londrina Solid', sans-serif;
}



table{
    border-collapse: collapse;
    width: 100%;
}

td, th{
    padding: 8px;
    text-align: center;
    height: 50px;
}


th{
    background-color: var(--couleur4);
}


tr:hover {
    background-color: var(--couleur4);
}

tbody tr{
    border-bottom: 1px solid var(--couleur4);
}
    </style>



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
        

        
        echo "<td><img src=\"{$album['image_album']}\" width=\"100px\"></td>";
        $genre = $dbAlbum->getGenreAlbumbyId($album["idalbum"]);
        echo "<td>{$genre[0]["nom_genre"] }</td>";
  
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