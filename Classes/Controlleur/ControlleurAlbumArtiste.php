<?php
namespace Controlleur;

use Auth\DBAlbum;
use Auth\DBArtiste;
use form\Form;
use form\type\File;
use form\type\Hidden;
use form\type\Link;
use form\type\Submit;
use form\type\Text;

class ControlleurAlbumArtiste extends Controlleur
{
    public function view()
    {
    $dbartistes= DBArtiste::getArtistes();


        if(!isset($_SESSION['auth'])){
            $this->redirect("ControlleurLogin", "view");
        }else{
            $this->render("albumArtiste.php", [ 
                "formRetour" => $this->getFormRetour(),
                "artistes" => $dbartistes,
            ]);
        }
    }

    public function submit()
    {
        $this->redirect("ControlleurAlbumArtiste", "view");
    }

    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurAlbumArtiste&action=submit", Form::GET, "album_form");
        $form->setController("ControlleurAlbum", "submitListeAlbum");

        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }

    public function getFormLink($idartiste){
        $form = new Form("/?controller=ControlleurAlbumArtiste&action=view", Form::GET, "home_form");
        $form->addInput(new Link("/?controller=ControlleurAlbumAjouter&action=view&id={$idartiste}", "Ajouter un album"));
        return $form;
    }

    
}