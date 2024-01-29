<?php
session_start();

if (isset($_SESSION['username'])) {
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];

    echo "<h1>Bonjour $prenom $nom </h1>";
    echo "<br><a href='register.php'>Créer un compte</a>";
    echo "<br><a href='logout.php'>Se deconnecter</a>";

} else {
    echo "<h1>Veuillez vous connecter</h1>";
    echo "<br><a href='login.php'>Se connecter</a>";
    echo "<br><a href='register.php'>Créer un compte</a>";
}
?>

