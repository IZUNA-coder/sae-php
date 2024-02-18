<?php

namespace Controlleur;

use Auth\DBAlbum;
use form\Form;
use form\type\Submit;
use form\type\Text;

class ControlleurModifier extends Controlleur{
    public function view(){
        $dbAlbum = DBAlbum::getAlbums();
        $this->render("modifierAdmin.php", ["form" => $this->getForm(), 
        'dbAlbum' => $dbAlbum,
        "formRetour" => $this->getFormRetour(),
        ]);
        
        }
    

        
    
    
    public function submit(){
        $db = new DBAlbum();
        $db->updateAlbum($_SESSION['idalbum'],$_POST['nom_album'], $_POST['annee_album'], "1");
        $this->redirect("ControlleurAlbum", "view");
    }
 
    private function getForm()
    {
        $form = new Form("/?controller=ControlleurModifier&action=submit", Form::POST, "login_form");
        $dbAlbum = DBAlbum::getAlbums();
        foreach($dbAlbum as $album){
            if($album['idalbum'] == $_GET['id']){
               $form->addInput((new Text($album['nom_album'], true,"nom_album", "album_id"))->setLabel("Nom album"));
               $form->addInput((new Text($album['annee_album'], true,"annee_album", "annee_id"))->setLabel("annee album"));
            }
        }

        $form->addInput(new Submit("Modifier", true, "", ""));
        $form->setController("ControlleurModifier", "submit");
        return $form;
    }

    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurAlbumAjouter&action=submit", Form::GET, "album_form");
        $form->setController("ControlleurAlbum", "submitListeAlbum");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }

}