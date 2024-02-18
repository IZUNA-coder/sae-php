<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>
<script defer>
function filtrages() {
    let input, selectGenre, selectAnnee, filterText, filterOptionGenre, filterOptionAnnee, albums, h4, txtValue, h3, txtValueAnnee;
    input = document.getElementById('recherche');
    selectGenre = document.getElementById('genreSelect');
    selectAnnee = document.getElementById('anneeSelect');

    filterText = input.value.toUpperCase();
    filterOptionGenre = selectGenre.value.toLowerCase();
    filterOptionAnnee = selectAnnee.value;

    albums = document.querySelectorAll('body > div');

    for (let i = 0; i < albums.length; i++) {
        h4 = albums[i].getElementsByTagName('h4')[0];
        h3 = albums[i].getElementsByTagName('h3')[0]; 
        if (h4) {
            txtValue = h4.innerText || h4.textContent;
            txtValue = txtValue.replace("Genre: ", "").toLowerCase();
        }
        if (h3) {
            txtValueAnnee = h3.innerText || h3.textContent; 
        }

        if ((filterText === "" || albums[i].className.toUpperCase().startsWith(filterText)) &&
            (filterOptionGenre === "" || (h4 && txtValue.includes(filterOptionGenre))) &&
            (filterOptionAnnee === "" || (h3 && txtValueAnnee === filterOptionAnnee))) {
            albums[i].style.display = "";
        } else {
            albums[i].style.display = "none";
        }
    }
}
</script>



<?php 
echo "<h1>Bienvenue {$_SESSION["prenom"]} </h1>";
echo $formRetour ?? null; 
echo $selectGenre ?? null;
echo $selectAnnee ?? null;
echo $formRecherche ?? null;

if($_SESSION["id_role"] == 1){
    echo "<section>";
    echo $formAdminAlbum ?? null;
    echo "</section>";
    
    echo "<section>";
    echo $formAdminArtiste ?? null;
    echo "</section>";
 

}

if($_SESSION["id_role"] == 2){
     
    foreach($albums as $album){
        echo "<div class='{$album['nom_album']}'>";
        echo "<h2> {$album['nom_album']}</h2>";
        echo "<h3> {$album['annee_album']}</h3>";
        echo "<img src='{$album['image_album']}' width='100px'>";
        echo "<br>";   
        $genre = $dbAlbum->getGenreAlbumbyId($album['idalbum']);
        echo "<h4 id={$genre[0]["nom_genre"]}> Genre: {$genre[0]['nom_genre']}</h4>";
        foreach($artistes as $artiste){
            if ($artiste['idartiste'] == $album['idartiste']) {
                echo $formLinks[$album['idalbum']] ?? null;
                echo "<h4> {$artiste['prenom_artiste']} {$artiste['nom_artiste']}</h4>";
                $_SESSION["idPage{$artiste['idartiste']}"] = $artiste['idartiste'];
                echo "</div>";
                break;  
            }
        } 
    }
}

?>



</body>
</html>