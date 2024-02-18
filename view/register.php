<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=*, initial-scale=1.0">
    <link rel="stylesheet" href="../static/css/register.css">
    <link rel="stylesheet" href="../static/css/banniere.css">
    <title>Register</title>
</head>
<body>
    <?php include 'banniere.php'; ?>
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