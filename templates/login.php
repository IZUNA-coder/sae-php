<?php
session_start();

function get_id_user($username, $password) {
    global $file_db;

    $query = $file_db->prepare("SELECT idutilisateur FROM UTILISATEUR WHERE pseudo = :username AND mdp = :mdp");
    $query->bindParam(':username', $username);
    $query->bindParam(':mdp', $password);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['idutilisateur'];
    } else {
        return null;
    }
}

$file_db = new PDO('sqlite:sound.sqlite3');

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $_SESSION['username'] = $username;
    
    
    $checkIfExists = $file_db->prepare("SELECT COUNT(*) FROM UTILISATEUR WHERE pseudo = :username AND mdp = :mdp");
    $checkIfExists->bindParam(':username', $username);
    $checkIfExists->bindParam(':mdp', $password);
    $checkIfExists->execute();
    
    if ($checkIfExists->fetchColumn() > 0) {
        $user_id = get_id_user($username, $password);
        $_SESSION['user_id'] = $user_id;
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Nom d'utilisateur ou Mot de Passe Invalide";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>

    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <form action="login.php" method="post">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mot de Passe:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login">
    </form>
</body>

</html>

