<?php
use View\Template;

require_once 'Configuration/config.php';

require 'Classes/autoloader.php'; 
Autoloader::register(); 


// Manage action / controller
$action = $_REQUEST['action'] ?? false;

ob_start();
switch ($action) {
    case 'submit':
        include './Action/link.php';
        break;
        
    default:
        include 'Action/form.php';
        break;
}
$content = ob_get_clean();

// Template
$template = new Template('templates');
$template->setLayout('main');
$template->setContent($content);

echo $template->compile();
