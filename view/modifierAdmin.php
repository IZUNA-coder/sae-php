<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
    <script src="../static/js/validation.js" defer></script>


</head>
<body   >
    <h1> Modification album  </h1>
    <?php
    echo $formRetour ?? null;
    echo $form ?? null;
    $_SESSION['idalbum'] = $_GET['id'];

    ?>
</body>
</html>