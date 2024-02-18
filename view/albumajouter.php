<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ajout Album</title>
</head>

<body>

    <?php



    echo "<h1>Ajout d'un Album à : {$_SESSION['pseudo_artiste']}</h1>";


    $idartiste = $_GET['id'];
    $_SESSION['id_artiste_choisi'] = $idartiste;

    echo $formRetour;
    echo '<br>';
    echo $formAjouter;



    if (isset($_SESSION["titre"])) {
        var_dump(
            $_SESSION["titre"],
            $_SESSION["annee_album"],
            $_SESSION["Image"]
        );
    }


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom_fichier = $_FILES['image']['name'];
            $fichier_tmp = $_FILES['image']['tmp_name'];

            $dossier_cible = "data/images/";
            $fichier_cible = $dossier_cible . basename($nom_fichier);

            if (move_uploaded_file($fichier_tmp, $fichier_cible)) {
                echo "Le fichier " . basename($nom_fichier) . " a été copié.";
            } else {
                echo "Désolé, une erreur s'est produite lors de la copie de votre fichier.";
            }
        }


    ?>

</body>

</html>