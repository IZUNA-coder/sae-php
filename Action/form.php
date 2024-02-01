<?php
session_start();


if (isset($_SESSION['username'])) {
    ?>
    <h1>Bonjour <?= $_SESSION['username'] ?></h1>
    <form method="post" action="/?action=submit">
    <input type="submit" name="action" value="connexion">
    <input type="submit" name="action" value="register">
</form>
    <?php
} else {
    ?>
    <h1>Veuillez vous connecter</h1>
<form method="get" action="link.php">
    <input type="submit" name="action" value="connexion">
    <input type="submit" name="action" value="register">
</form>

    <?php
}
?>
