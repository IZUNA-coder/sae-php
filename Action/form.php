<?php
namespace Action;


if (isset($_SESSION['username'])) {
    ?>
    <h1>Bonjour <?= $_SESSION['username'] ?></h1>
    <form method="get" action="link.php">
        <input type="hidden" name="action" value="connexion">
        <input type="submit" value="Connexion">
    </form>
    <form method="get" action="link.php">
        <input type="hidden" name="action" value="register">
        <input type="submit" value="Register">
    </form>
    <?php
} else {
    ?>
    <h1>Veuillez vous connecter</h1>
    <form method="get" action=      
        <input type="hidden" name="action" value="connexion">
        <input type="submit" value="Connexion">
    </form>
    <form method="get" action="link.php?action=register">
        <input type="hidden" name="action" value="register">
        <input type="submit" value="Register">
    </form>
    <?php
}
?>