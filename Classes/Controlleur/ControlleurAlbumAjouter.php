<?php
namespace Controlleur;

use Auth\DBAlbum;
use form\Form;
use form\type\File;
use form\type\Submit;
use form\type\Text;

class ControlleurAlbumAjouter extends Controlleur
{
    public function view()
    {
    $dbAlbum = new DBAlbum();

        if(!isset($_SESSION['auth'])){
            $this->redirect("ControlleurLogin", "view");
        }else{
            $this->render("albumajouter.php", [ 
                "formRetour" => $this->getFormRetour(),
                "formAjouter" => $this->getFormAjouter(),
            ]);
        }
    }

    public function submit()
    {
        $this->redirect("ControlleurAlbumAjouter", "view");
    }
    

    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurAlbum&action=submit", Form::GET, "album_form");
        $form->setController("ControlleurAlbum", "submit");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }

    public function getFormAjouter()
    {
        $form = new Form("/?controller=ControlleurAlbumAjouter&action=submit", Form::POST, "album_form");
        $form->setController("ControlleurAlbumAjouter", "submit");
        $form->addInput(new Text("titre", "Titre", true, $_SESSION['titre'] ?? "", "", "Titre de l'album"));
        $form->addInput(new Text("annee_album", "Annee", true, $_SESSION['annee_album'] ?? "", "", "Annee de l'album"));
        $form->addInput(new File("image_album", "Image", true, "", "", "Image de l'album"));
        $form->addInput(new Submit("Ajouter", true, "", ""));
        return $form;
    }

    
}