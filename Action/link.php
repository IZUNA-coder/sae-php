<?php
namespace Action;
session_start();

if (isset($_GET['action'])) {
    $action = $_GET ['action'];


    switch ($action) {
        case 'register':
            echo "Redirecting to register.php";
            header("Location: ../templates/register.php");
            exit();
            break;  
        case 'logout':
            header("Location: ../templates/logout.php");
            exit(); 
            break;
        case 'chanson':
            echo "Redirecting to chanson.php";
            header('Location: chanson.php');
            break;
        case 'login':
            header("Location: ../templates/login.php");
            exit();
            break;
        case 'some_value':
            echo "You chose some_value";
            break;
        default:
            echo "Unknown action: $action";
            break;
    }
}
