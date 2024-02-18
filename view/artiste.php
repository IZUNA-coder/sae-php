<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artistes</title>
    
    <script defer>
        window.onload = function() {
            let inputFields = document.querySelectorAll("#artiste_id");
            inputFields.forEach((inputField, index) => {
                if(inputField){
                    console.log(`Input field ${index + 1}:`, inputField.value);
                }else{
                    console.log("Input field not found");
                }
            });
            let test = document.querySelectorAll("test");
            console.log(test.value);
        };

        function confirmAction() {
            if(confirm("Voulez-vous vraiment supprimer cet artiste?")){
                return true;
            }else{
                return false;
            }
        }
    </script>

</head>
<body>

<?php 

if($artistes ?? null && !empty($artistes)){
    echo "<h2>Artistes</h2>";
    echo "<table class='tab-groupes'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Nom</th>";
    echo "<th>Image</th>";
    echo "<th>Modification</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach($artistes as $artiste){ 
        echo '<tr>';
        echo "<td> {$artiste['idartiste']}</td>";
        echo "<td>{$artiste['nom_artiste']}</td>";
        echo '<td>';
        
        $formDelete = $this->getFormDeleteAdmin($artiste['idartiste']);
        $formAdd = $this->getFormAddAdmin($artiste['idartiste']);
        echo $formDelete ?? null;    
        echo $formLinks ?? null;
        echo $formAdd ?? null;

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