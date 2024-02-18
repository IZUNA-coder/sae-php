<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ajout Album</title>
    <script src="../static/js/validation.js" defer></script>
</head>

<body>




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
