<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/login.css">
    <link rel="stylesheet" href="../static/css/banniere.css">
    <title>Login</title>
</head>
<body>
    <?php include 'banniere.php'; ?>
    <?php 
    if(isset($_SESSION['errorConnexion'])) {
        echo $_SESSION['errorConnexion'];
    }
    echo $form ?? null; 
    echo $formRegister ?? null;
?>

</body>
</html>