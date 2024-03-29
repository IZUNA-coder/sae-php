<?php
namespace Controlleur;

use Auth\DBAuth;
use form\Form;
use form\type\Link;
use form\type\Submit;
use form\type\Text;
use form\type\PasswordField;

class ControlleurLogin extends Controlleur
{
    
    public function view()
    {   
        if(isset($_SESSION['auth'])){
            $this->redirect("ControlleurHome", "view");
        }else{
            $this->render("login.php", ["form" => $this->getForm(),
        "formRegister" => $this->getFormRegister()]);
        }
    }

   
    public function getFormRegister()
    {   
        $form = new Form("/?controller=ControlleurHome&action=view", Form::GET, "home_form");
        $form->setController("ControlleurHome", "submit");
        $form->addInput(new Link("/?controller=ControlleurRegister&action=view", "Créer un compe"));
        return $form;
    }

    
    

    public function submit()
    {
        $username = $_POST['pseudo'];
        $password = $_POST['password'];
        $auth = new DBAuth;
        $user = $auth->login($username, $password);
        if($user){
            $this->redirect("ControlleurHome", "view");
        }else{
            $_SESSION['errorConnexion'] = "Nom d'utilisateur ou mot de passe incorrect";
            $this->redirect("ControlleurLogin", "view");
        }
    }


    private function getForm()
    {
        $form = new Form("/?controller=ControlleurLogin&action=submit", Form::POST, "login_form");
        $form->addInput((new Text("", true,"pseudo", "pseudo"))->setLabel("Nom d'utilisateur"));
        $passwordField = new PasswordField("", true, "password", "password");
        $passwordField->setLabel("Mot de passe");
        $form->addInput($passwordField);
        $form->setController("ControlleurLogin", "submit");
        $form->addInput(new Submit("Connexion", true, "connexion", "connexionId"));
        return $form;
    }
}