<?php
session_start();

if (isset($_SESSION['username'])) {
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];

    echo "<h1>Bonjour $prenom $nom </h1>";
} else {
    echo "<h1>Veuillez vous connecter</h1>";
}
?>

