<?php

namespace Controlleur;
use Auth\DBAlbum;
use Auth\DBArtiste;
use Auth\DBChanson;
use Controlleur\Controlleur;
use form\Form;
use form\type\Submit;

class ControlleurMusique extends Controlleur
{
    public function view()
    {
        if(!isset($_SESSION['auth'])){
            $this->redirect("ControlleurLogin", "view");
        }else{
            $chanson =new DBChanson();
            $artiste = new DBArtiste();
            $album = new DBAlbum();

            
            $this->render("musique.php", [
                "form" => $this->getFormRetour(),
                "chansonsbyid" => $chanson->getchansonInAlbum($_GET['id']), 
                "chansons" => $chanson->getChanson(), 
                "artistes" => $artiste->getArtistes(),
                "albumbyid" => $album->getAlbumById($_GET['id']), 
            ]);
        }
    }

    public function submit()
    {
        $this->redirect("ControlleurHome", "view");
    }

    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurMusique&action=submit", Form::GET, "musique_form");
        $form->setController("ControlleurMusique", "submit");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }

}