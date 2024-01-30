<?php
session_start();

if (isset($_SESSION['username'])) {

    echo "<h1>Bonjour User </h1>";
    echo "<br><a href='register.php'>Créer un compte</a>";
    echo "<br><a href='logout.php'>Se deconnecter</a>";
    $file_db = new PDO('sqlite:sound.sqlite3');

$query = $file_db->query("SELECT * FROM ALBUM");

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
    $id_album = $row['idalbum'];
    echo "<a href='chanson.php?idalbum=$id_album'><section>";
    foreach ($row as $key => $value) {
        if ($key == "image_album") {
            echo "<img src='$value' width='100px'>";
        }
        if ($key == "nom_album") {
            echo "<h2>$value</h2>";
        }
        if ($key == "annee_album") {
            echo "<h3>$value</h3>";
        }
        if ($key == "idartiste") {
            $query2 = $file_db->query("SELECT * FROM ARTISTE WHERE idartiste = $value");
            while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
                foreach ($row2 as $key2 => $value2) {
                    if ($key2 == "pseudo_artiste") {
                        echo "<h4>$value2</h4>";
                    }
                }
            }
        }
      
    }
    echo "</section></a>";

    echo "<hr>";

}
} else {
    echo "<h1>Veuillez vous connecter</h1>";
    echo "<br><a href='login.php'>Se connecter</a>";
    echo "<br><a href='register.php'>Créer un compte</a>";
}
?>

