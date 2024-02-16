<?php



use Classes\Autoloader;
use Controlleur\ControlleurAlbum;
use Controlleur\ControlleurAlbumAjouter;
use Controlleur\ControlleurAlbumArtiste;
use Controlleur\ControlleurHome;
use Controlleur\ControlleurLogin;
use Controlleur\ControlleurModifier;
use Controlleur\ControlleurMusique;
use Controlleur\ControlleurRegister;

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
        case "ControlleurAlbum":
            $controller = new ControlleurAlbum($_REQUEST);
            break;
        case "ControlleurMusique":
            $controller = new ControlleurMusique($_REQUEST);
            break;
        case "ControlleurRegister":
            $controller = new ControlleurRegister($_REQUEST);
            break;
        case "ControlleurAlbumAjouter":
            $controller = new ControlleurAlbumAjouter($_REQUEST);
            break;
        case "ControlleurAlbumArtiste":
            $controller = new ControlleurAlbumArtiste($_REQUEST);
            break;
        case "ControlleurModifier":
            $controller = new ControlleurModifier($_REQUEST);
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