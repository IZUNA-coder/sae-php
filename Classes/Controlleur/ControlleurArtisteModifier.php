<?php


namespace Controlleur;


use Auth\DBArtiste;
use form\Form;
use form\type\Submit;
use form\type\Text;


class ControlleurArtisteModifier extends Controlleur{


    public function view(){
        $this->render("modifierAdmin.php", ["form" => $this->getForm(),
        "formRetour" => $this->getFormRetour(),
        ]);
    }    
   
    public function submit(){
        $db = new DBArtiste();
        $db->updateArtiste($_SESSION['idartiste'],$_POST['nom_artiste']);
        $this->redirect("ControlleurArtiste", "view");
    }
 
    private function getForm(){
        $form = new Form("/?controller=ControlleurArtisteModifier&action=submit", Form::POST, "login_form");
        $artistes = DBArtiste::getArtistes();
        foreach($artistes as $artiste){
            if($artiste['idartiste'] == $_GET['id']){
                $form->addInput((new Text($artiste['pseudo_artiste'], true,"nom_artiste", "artiste_id"))->setLabel("Nom Artiste "));
            }
        }
       
        $form->addInput(new Submit("Modifier", true, "", ""));
        $form->setController("ControlleurArtisteModifier", "submit");
        return $form;
    }
       
   
    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurArtiste&action=submit", Form::GET, "Artiste_form");
        $form->setController("ControlleurArtiste", "submit");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }


}
