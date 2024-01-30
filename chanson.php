<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chanson</title>
    <script src="./js/bouton.js" defer></script>
</head>
<body>
    <h1>Chanson de l'album</h1>
    <a href="index.php">Retour</a>
    <?php
    session_start();
if (isset($_GET['idalbum'])) {
    $id_album = $_GET['idalbum'];
    echo "Id Album: $id_album";

    $file_db = new PDO('sqlite:sound.sqlite3');

    $contientAlbum = $file_db->query("SELECT * FROM CONTENIR_ALBUM WHERE idalbum = $id_album");
    $playlist = $file_db->query("SELECT * FROM PLAYLIST WHERE idutilisateur = {$_SESSION['user_id']}");
    $playlist->execute();
    $result = $playlist->fetch(PDO::FETCH_ASSOC);
    if ($result !== false) {
        $id_playlist = $result['id_playlist'];
        print_r($id_playlist);
    } 
    while ($chanson = $contientAlbum->fetch(PDO::FETCH_ASSOC)) {
        $id_chanson = $chanson['idchanson'];
    
        $query2 = $file_db->query("SELECT * FROM CHANSON WHERE idchanson = $id_chanson");
        print_r($_SESSION);
        while ($row2 = $query2->fetch(PDO::FETCH_ASSOC)) {
            if ($row2['idchanson'] == $id_chanson) {
                echo "<h2>".$row2['nom_chanson']."</h2>";
                echo "<h3>".$row2['duree_chanson']."</h3>";
            }
        }

        
        echo '<form method="POST">';
        echo '<input type="hidden" name="id_playlist" value="'.$id_playlist.'">';
        echo '<input type="hidden" class="chanson" name="id_chanson" value="'.$id_chanson.'">';
        echo '<input type="submit" class="addPlaylist" value="Ajouter dans ma playlist"></form>';
    }
    
} else {
    echo "Pas de chanson";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_playlist'], $_POST['id_chanson'])) {
        $id_playlists = $_POST['id_playlist'];
        $id_chansons = $_POST['id_chanson'];
        $checkQuery = $file_db->prepare("SELECT * FROM CONTENIR WHERE id_playlist = :id_playlist AND idchanson = :id_chanson");
        $checkQuery->bindParam(':id_playlist', $id_playlists);
        $checkQuery->bindParam(':id_chanson', $id_chansons);
        $checkQuery->execute();

        if ($checkQuery->fetchColumn() > 0) {
            $deleteQuery = $file_db->prepare("DELETE FROM CONTENIR WHERE id_playlist = :id_playlist AND idchanson = :id_chanson");
            $deleteQuery->bindParam(':id_playlist', $id_playlists);
            $deleteQuery->bindParam(':id_chanson', $id_chansons);
            $deleteQuery->execute();
        } else {
            $insertQuery = $file_db->prepare("INSERT INTO CONTENIR (id_playlist, idchanson) VALUES (:id_playlist, :id_chanson)");
            $insertQuery->bindParam(':id_playlist', $id_playlists);
            $insertQuery->bindParam(':id_chanson', $id_chansons);
            $insertQuery->execute();
        }
    }
}
?>
</body>
</html>