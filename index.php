<?php



use Classes\Autoloader;
use Controlleur\ControlleurAlbum;
use Controlleur\ControlleurHome;
use Controlleur\ControlleurLogin;
use Controlleur\ControlleurMusique;

if(!isset($_SESSION)){ 
    session_start(); 
}

require_once 'Configuration/config.php';
require './Classes/autoloader.php';
require "./data/convert_data.php";

Autoloader::register(); 

if(isset($_GET['controller']) && isset($_GET['action'])){
    $controllerName = $_GET["controller"];

    switch($controllerName) {
        case "ControlleurHome":
            $controller = new ControlleurHome($_REQUEST);
            break;
        case "ControlleurLogin":
            $controller = new ControlleurLogin($_REQUEST);
            break;
        case "ControlleurAlbum": // sert a rien pour le moment
            $controller = new ControlleurAlbum($_REQUEST);
            break;
        case "ControlleurMusique":
            $controller = new ControlleurMusique($_REQUEST);
            break;
        default:
            $controller = null;
    }

    if(!is_null($controller)){
        $actionName = $_GET["action"];
            echo $controller->$actionName();
    }

}else{
    $controllerName = 'ControlleurHome';
    $controller = new ControlleurHome();
    $controller->view();
}