<?php
namespace Action;

if (isset($_SESSION['username'])) {
    ?>
    <h1>Bonjour <?= $_SESSION['username'] ?></h1>
    <form method="get">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Deconnexion">
    </form>
    <form method="get" action="link.php">
        <input type="hidden" name="action" value="register">
        <input type="submit" value="Register">
    </form>
    <?php
} else {
    ?>
    <h1>Veuillez vous connecter</h1>
    <form method="get">
        <input type="hidden" name="action" value="login">
        <input type="submit" value="Connexion">
    </form>
    
    <form method="get">
        <input type="hidden" name="action" value="register">
        <input type="submit" value="Register">
    </form>
    <?php
    


}
?>