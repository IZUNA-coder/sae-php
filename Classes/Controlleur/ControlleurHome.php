<?php
namespace Controlleur;

use Auth\DBAlbum;
use Auth\DBArtiste;
use Auth\DBAuth;
use form\Form;
use form\type\Link;
use form\type\Submit;   

class ControlleurHome extends Controlleur
{
   
    public function view()
    {
        if(!isset($_SESSION['auth'])){
            $this->redirect("ControlleurLogin", "view");
        } else {
            $albums = DBAlbum::getAlbums();
            $artistes = DBArtiste::getArtistes();
            $formLinks = [];

            foreach($albums as $album) {
                foreach($artistes as $artiste) {
                    if ($artiste['idartiste'] == $album['idartiste']) {
                        $formLinks[$album['idartiste']] = $this->getFormLink($artiste['idartiste']);
                        break;
                    }
                }
            }

            if($_SESSION['id_role'] == 1){
                $this->render("main.php", [
                    "formRetour" => $this->getFormDeconnexion(),
                    "utilisateur" => $_SESSION['pseudo'] ?? "aucun",
                    "email" => $_SESSION['email'],
                    "nom" => $_SESSION['nom'],
                    "prenom" => $_SESSION['prenom'],
                    "mdp" => $_SESSION['mdp'],
                    "formRegister" => $this->getFormRegister(),
                    "formAdminAlbum" => $this->getFormAdminAlbum(),
                    "formAdminArtiste" => $this->getFormAdminArtiste(),
                ]);
            }else{
                $this->render("main.php", [
                    "formRetour" => $this->getFormDeconnexion(),
                    "utilisateur" => $_SESSION['pseudo'] ?? "aucun",
                    "email" => $_SESSION['email'],
                    "nom" => $_SESSION['nom'],
                    "prenom" => $_SESSION['prenom'],
                    "mdp" => $_SESSION['mdp'],
                    "artistes" => $artistes,
                    "albums" => $albums,
                    "formLinks" => $formLinks,
            ]);
        }
        }
    }

    public function submit()
    {
        $auth = new DBAuth();
        $auth->logout();
        $this->redirect("ControlleurLogin", "view");
    }

    public function getFormDeconnexion()
    {
        $form = new Form("/?controller=ControlleurHome&action=submit", Form::GET, "home_form");
        $form->setController("ControlleurHome", "submit");


        $form->addInput(new Submit("Deconnexion", true, "", ""));
        return $form;
    }

    public function getFormRegister()
    {   
        $form = new Form("/?controller=ControlleurHome&action=view", Form::GET, "home_form");
        $form->setController("ControlleurHome", "submit");
        $form->addInput(new Link("/?controller=ControlleurRegister&action=view", "Register"));
        return $form;
    }
  

    public function getFormLink($idartiste){
        $form = new Form("/?controller=ControlleurHome&action=view", Form::GET, "home_form");
        $form->setController("ControlleurHome", "submit");
        $form->addInput(new Link("/?controller=ControlleurMusique&action=view&id={$idartiste}", "Albums"));
        return $form;
    }

    public function getFormAdminAlbum(){
        $form = new Form("/?controller=ControlleurHome&action=view", Form::GET, "home_form");
        $form->setController("ControlleurHome", "submit");
        $form->addInput(new Link("/?controller=ControlleurAlbum&action=view", "Albums"));
        return $form;
    }

    public function getFormAdminArtiste(){
        $form = new Form("/?controller=ControlleurHome&action=view", Form::GET, "home_form");
        $form->setController("ControlleurHome", "submit");
        $form->addInput(new Link("/?controller=ControlleurArtiste&action=view", "Artistes"));
        return $form;
    }

}