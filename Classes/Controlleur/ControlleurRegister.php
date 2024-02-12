<?php

namespace Controlleur;
use Auth\DBAuth;
use Auth\DBPlaylist;
use form\Form;
use form\type\Submit;
use form\type\Text;
use form\type\PasswordField;
use form\type\MailField;


class ControlleurRegister extends Controlleur{

    public function view()
    {
            $this->render("register.php", ["form" => $this->getForm()]);
    }

    public function submit()
    {
        $username = $_POST['pseudo'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $auth = new DBAuth;
        $playlist = new DBPlaylist;
        $user = $auth->addUser($username, $password, $email, $nom, $prenom);
        $_SESSION["userRegister"] = $user;
        if($user){
            $auth->login($username, $password);
            $playlist->addPlaylist("ma Playlist", $_SESSION["auth"]);
            $this->redirect("ControlleurHome", "view");
        }else{
            $_SESSION['error'] = "Nom d'utilisateur ou mot de passe incorrect";
            $this->redirect("ControlleurRegister", "view");
        }
    }

    private function getForm()
    {
        $form = new Form("/?controller=ControlleurRegister&action=submit", Form::POST, "register_form");
        $form->addInput((new Text("", true,"pseudo", "pseudo"))->setLabel("Nom d'utilisateur"));
        $passwordField = new PasswordField("", true, "password", "password");
        $passwordField->setLabel("Mot de passe");
        $form->addInput($passwordField);
        $form->addInput((new MailField("", true,"email", "email"))->setLabel("Email"));
        $form->addInput((new Text("", true,"nom", "nom"))->setLabel("Nom"));
        $form->addInput((new Text("", true,"prenom", "prenom"))->setLabel("Prenom"));
        $form->setController("ControlleurRegister", "submit");
        $form->addInput(new Submit("Inscription", true, "inscription", "inscriptionId"));
        return $form;
    }
}