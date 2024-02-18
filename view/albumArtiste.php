<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/banniere.css">
    <link rel="stylesheet" href="../static/css/albumAdmin.css">
    <title>Artiste a choisir</title>
</head>
<body>
    <?php include 'banniere.php'; ?>
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