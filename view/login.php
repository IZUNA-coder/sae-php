<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php 
    if(isset($_SESSION['errorConnexion'])) {
        echo $_SESSION['errorConnexion'];
    }
    echo $form ?? null; 
    echo $formRegister ?? null;
?>

</body>
</html>