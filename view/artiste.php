<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artistes</title>
    <link rel="stylesheet" href="../static/css/albumAdmin.css">

</head>
<body>

<?php 

$formAdd = $this->getFormAddAdmin(1);
echo $formRetour ?? null;
echo $formAdd ?? null;

if($artistes ?? null && !empty($artistes)){
    echo "<h2>Artistes</h2>";
    echo "<table class='tab-groupes'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Pseudo Artiste</th>";
    echo "<th>Modification</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach($artistes as $artiste){ 
        echo '<tr>';
        echo "<td> {$artiste['idartiste']}</td>";
        echo "<td>{$artiste['pseudo_artiste']}</td>";
        echo '<td>';
        
        $formDelete = $this->getFormDeleteAdmin($artiste['idartiste']);
        $formModifier = $this->getFormLink($artiste['idartiste']);

        echo $formDelete ?? null;    
        echo $formLinks ?? null;
        echo $formModifier ?? null; 

        echo '</td>';
        echo '</tr>';
       
    }
    echo "</tbody>";
    echo "</table>";
}else{
    echo "<h2>Artistes</h2>";
    echo "<p>Il n'y a pas d'artistes</p>";
}
?>
</body>
</html>