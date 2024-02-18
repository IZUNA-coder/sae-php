<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artiste a choisir</title>
    
</head>
<body>
    <?php
    echo $formRetour;
    echo '<br>';
    foreach($artistes as $artiste){
        echo "<section>";
        echo "<h1>{$artiste['pseudo_artiste']}</h1>";
        echo $this->getFormLink($artiste['idartiste']);
        echo "</section>";
        echo '<br>';
    }
    ?>
</body>
</html>