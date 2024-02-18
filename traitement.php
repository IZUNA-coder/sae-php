<?php

print_r($_FILES);

if(isset($_FILES['image'])) {

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