<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script defer>

function filtrages() {
    let input, select, filterText, filterOption, albums, h4, txtValue;
    input = document.getElementById('recherche');
    select = document.getElementById('genreSelect');
    filterText = input.value.toUpperCase();
    filterOption = select.value.toLowerCase();

    albums = document.querySelectorAll('body > div');

    for (let i = 0; i < albums.length; i++) {
        h4 = albums[i].getElementsByTagName('h4')[0];
        if (h4) {
            txtValue = h4.innerText || h4.textContent;
            txtValue = txtValue.replace("Genre: ", "").toLowerCase();
        }

        if ((filterText === "" || albums[i].className.toUpperCase().startsWith(filterText)) &&
           (filterOption === "" || (h4 && txtValue.includes(filterOption)))) {
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
echo $Select ?? null;
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
                var_dump($album['idalbum']);
                echo $formLinks[$artiste['idartiste']] ?? null;
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