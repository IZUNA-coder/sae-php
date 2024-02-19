<?php

namespace Controlleur;

use Auth\DBPlaylist;
use form\Form;
use form\type\Hidden;
use form\type\Submit;

class ControlleurPlaylist extends Controlleur{

    public function view(){
        $dbPlaylist = new DBPlaylist();
        $dbPlaylist->getIdChansonInPlaylist($_SESSION['playlists'][0]['id_playlist']);
        $this->render("playlist.php", [
            "formRetour" => $this->getFormRetour(),
            "playlist" => DBPlaylist::getPlaylistById($_SESSION["auth"]),
            "dbPlaylist" => $dbPlaylist,
            
        ]);
    }

    public function submit(){
        $this->redirect("ControlleurPlaylist", "view");
    }

    public function submitSupprimer(){
        $dbPlaylist = new DBPlaylist();
        if(isset($_POST['chanson_id'])){
            $dbPlaylist->deleteChansonFromPlaylist($_POST["chanson_id"], $_SESSION['playlists'][0]['id_playlist']);
        }
        $this->redirect("ControlleurPlaylist", "view");
    }


    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurPlaylist&action=submit", Form::GET, "playlist_form");
        $form->setController("ControlleurHome", "view");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }

   
    public function getFormChanson($idChanson){
        $form = new Form("/?controller=ControlleurPlaylist&action=submitSupprimer", Form::POST, "playlist_form");
            
        $form->setController("ControlleurPlaylist", "submitSupprimer");
        $form->addInput((new Hidden($idChanson, true, "chanson_id", "chanson_id")));

        $form->addInput(new Submit("Supprimer", true, "", ""));
        return $form;

    }
}