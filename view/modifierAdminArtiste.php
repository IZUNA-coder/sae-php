<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/banniere.css">
    <link rel="stylesheet" href="../static/css/albumAdmin.css">
    <title>Modification Artiste</title>
    <script src="../static/js/validation.js" defer></script>


</head>
<body>
    <?php include 'banniere.php'; ?>
    <h1> Modification artiste  </h1>
    <?php
    echo $formRetour ?? null;
    echo $form ?? null;
    $_SESSION['idartiste'] = $_GET['id'];

    ?>
</body>
</html>