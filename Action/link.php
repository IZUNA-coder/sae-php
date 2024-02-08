<?php
namespace Action;
session_start();

print_r("Hello World");

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST ['action'];

    print_r($action);

    switch ($action) {
        case 'register':
            echo "Redirecting to register.php";
            header('Location: register.php');
            break;
        case 'logout':
            echo "Redirecting to logout.php";
            header('Location: logout.php');
            break;
        case 'chanson':
            echo "Redirecting to chanson.php";
            header('Location: chanson.php');
            break;
        case 'connexion':
            echo "Redirecting to connexion.php";
            header('Location: login.php');
            break;
        default:
            echo "Unknown action: $action";
            break;
    }
}
