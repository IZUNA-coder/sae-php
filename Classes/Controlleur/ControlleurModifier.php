<?php

namespace Controlleur;

use form\Form;
use form\type\Submit;
use form\type\Text;

class ControlleurModifier extends Controlleur{
    public function view(){
        $this->render("modifierAdmin.php", ["form" => $this->getForm()]);
    }
    public function submit(){
        $this->redirect("ControlleurModifier", "view");
    }
    
    private function getForm()
    {
        $form = new Form("/?controller=ControlleurModifier&action=submit", Form::POST, "login_form");
        $form->addInput((new Text("", true,"nom_album", "album_id"))->setLabel("Nom album"));
        $form->addInput((new Text("", true,"annee_album", "annee_id"))->setLabel("annee album"));
       
        $form->setController("ControlleurModifier", "submit");
        return $form;
    }
}