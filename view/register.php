<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php 
    if(isset($_SESSION['errorAdd'])) {
        echo $_SESSION['errorAdd'];
    }else{
        unset($_SESSION['errorAdd']);
    }
    echo $form ?? null; 
?>

</body>
</html>