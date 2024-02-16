<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ url_for('static', filename='admin/groupe.css')}}">
    <meta charset="UTF-8">
    <title>Ajout Album</title>
</head>
<body>
    
<h1>dsdsd</h1>
<?php
if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
      
    $extensions= array("jpeg","jpg","png");
      
    if(in_array($file_ext,$extensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }
      
    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"data/images/".$file_name);
        echo "Success";
    }else{
        print_r($errors);
    }
}

$idartiste = $_GET['id'];
$_SESSION['id_artiste_choisi'] = $idartiste;

echo $formRetour;
echo '<br>';
echo $formAjouter;

    if(isset($_SESSION["titre"])){
    var_dump( $_SESSION["titre"],
    $_SESSION["annee_album"],
    $_SESSION["Image"])
    ;}
    
?>  

</body>
</html>