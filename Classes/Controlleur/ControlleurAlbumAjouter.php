<?php
namespace Controlleur;

use Auth\DBAlbum;
use form\Form;
use form\type\Submit;

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
                "nom_album" => $_SESSION['titre'] ?? "aucun album",
                "anneeAlbum" => $_SESSION['annee_album'] ?? "aucune annee",
                "imageAlbum" => $_SESSION['image_album'] ?? "aucune image",
                "albumbyid" => $dbAlbum->getAlbumById($_GET['id']),
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
        $form->addInput(new Submit("Ajouter", true, "", ""));
        return $form;
    }

    
}