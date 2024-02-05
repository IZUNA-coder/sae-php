<?php
namespace Action;
print_r("Hello World");
// Check if the 'action' parameter is present in the URL
if (isset($_GET['action'])) {
    $action = $_GET['action']; // Get the value of the 'action' parameter

    // Debugging: Output the value of $action
    var_dump($action);

    // Do something based on the value of 'action'
    switch ($action) {
        case 'login':
            echo "Redirecting to login.php";
            header('Location: templates');
            exit();
        case 'register':
            echo "Redirecting to register.php";
            header('Location: register.php');
            exit();
        case 'logout':
            echo "Redirecting to logout.php";
            header('Location: logout.php');
            exit();
        case 'chanson':
            echo "Redirecting to chanson.php";
            header('Location: chanson.php');
            exit();
        case 'connexion':
            echo "Redirecting to connexion.php";
            header('Location: login.php');
            exit();
        // Add more cases as needed
        default:
            echo "Unknown action: $action";
            break;
    }
}
