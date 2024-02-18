<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ajout Album</title>
</head>

<body>




    <?php



    echo "<h1>Ajout d'un Album à : {$_SESSION['pseudo_artiste']}</h1>";


    $idartiste = $_GET['id'];
    $_SESSION['id_artiste_choisi'] = $idartiste;

    echo $formRetour;
    echo '<br>';
    echo $formAjouter;



    if (isset($_SESSION["titre"])) {
        var_dump(
            $_SESSION["titre"],
            $_SESSION["annee_album"],
            $_SESSION["Image"]
        );
    }




    ?>

</body>

<script>
  
        document.querySelector("#addAlbumForm").addEventListener("submit", function(event) {
        event.preventDefault();
        
        changerActionDuFormulaire();

        console.log("submit intercepted");
        
        this.submit();

        document.querySelector("#addAlbumForm").action = "/?controller=ControlleurAlbumAjouter&action=submitAdd";

        console.log("submit de base ");

        this.submit();
    });

      function changerActionDuFormulaire() {
        var form = document.querySelector("#addAlbumForm");
        form.action = "traitement.php"; 
        console.log("changer action du formulaire");

    }
</script>
</html>