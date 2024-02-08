<?php
namespace Action;

use form\Form;
use form\type\Submit;

if (isset($_SESSION['username'])) {
    $logoutForm = new Form("", Form::GET, "id_logout");
    $logoutForm->addInput(new Submit("logout", "submit", "logout", "id_logout"));
    $registerForm->setController("logout", "logout");


    $registerForm = new Form("register", Form::GET, "id_register");
    $registerForm->addInput(new Submit("register", true, "register", "id_register"));
    $registerForm->setController("register", "register");


    echo "<h1>Bonjour {$_SESSION['username']}</h1>";
    echo $logoutForm;
    echo $registerForm;
} else {
    $loginForm = new Form("login", Form::GET, "id_login");
    $loginForm->addInput(new Submit("login", true,"action", "id_login"));
    $loginForm->setController("login", "login");


    $registerForm = new Form("register", Form::GET, "id_register");
    $registerForm->addInput(new Submit("register", "action", "register", "id_register"));
    $registerForm->setController("register", "register");


    echo "<h1>Veuillez vous connecter</h1>";
    echo $loginForm;
    echo $registerForm;
}