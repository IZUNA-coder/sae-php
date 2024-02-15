<?php

namespace Controlleur;

use form\Form;
use form\type\Submit;

class ControlleurDelete extends Controlleur {
    public function view() {
        $this->render("deleteAdmin.php", ["form" => $this->getForm()]);
    }

    public function submit() {
        $this->redirect("ControlleurHome", "view");
    }

    private function getForm() {
        $form = new Form("/?controller=ControlleurDelete&action=submit", Form::POST, "delete_form");
        $form->setController("ControlleurDelete", "submit");
        $form->addInput(new Submit("Supprimer", true, "supprimer", "supprimerId", "confirmAction()"));
        return $form;
    }
}