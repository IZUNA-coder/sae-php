<?php

$file_db = new PDO('sqlite:sound.sqlite3');
print_r($file_db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $id_role = 2;

    $verifUser = $file_db -> prepare("SELECT COUNT(*) FROM UTILISATEUR WHERE pseudo = :pseudo");
    $verifUser -> bindParam(':pseudo', $pseudo);
    $verifUser -> execute();

    if($verifUser->fetchColumn() > 0){
        $error_message = "Ce pseudo est déjà utilisé";
    }else{
        $insert = "INSERT INTO UTILISATEUR (pseudo, nom, prenom, email, mdp, id_role) VALUES (:pseudo, :nom, :prenom, :email, :mdp , :id_role)";
        $stmt = $file_db -> prepare($insert);
        $stmt -> bindParam(':pseudo', $pseudo);
        $stmt -> bindParam(':nom', $nom);
        $stmt -> bindParam(':prenom', $prenom);
        $stmt -> bindParam(':email', $email);
        $stmt -> bindParam(':mdp', $mdp);
        $stmt -> bindParam(':id_role', $id_role);
        $stmt -> execute();
        $_SESSION['username'] = $pseudo;

        echo "Insertion de $pseudo en base réussie !<br/>";
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de Compte</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Créer un Compte</h1>

    <?php
    if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
    }
    ?>

    <form action="register.php" method="post">
        <label for="pseudo">Pseudo:</label>
        <input type="text" id="pseudo" name="pseudo" required>


        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>
        

        <label for="prenom">Prenom:</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>

        <label for="mdp">mdp:</label>
        <input type="mdp" id="mdp" name="mdp" required>

      

        <input type="submit" value="Créer un Compte">
    </form>
</body>

</html>