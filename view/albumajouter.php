<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ajout Album</title>
    <script src="../static/js/validation.js" defer></script>
    <link rel="stylesheet" href="../static/css/albumAdmin.css">
    <link rel="stylesheet" href="../static/css/banniere.css">
</head>

<body>

    <?php include 'banniere.php'; ?>


    <?php



    echo "<h1>Ajout d'un Album à : {$_SESSION['pseudo_artiste']}</h1>";


    $idartiste = $_GET['id'];
    $_SESSION['id_artiste_choisi'] = $idartiste;

    echo $formRetour;
    echo '<br>';
    echo $formAjouter;


    ?>

</body>


</html>
