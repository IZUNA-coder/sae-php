<?php

namespace Controlleur;
use Auth\DBAlbum;
use Auth\DBArtiste;
use Auth\DBChanson;
use Auth\DBPlaylist;
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
            $te = new DBPlaylist();
            
            $this->render("musique.php", [
                "formRetour" => $this->getFormRetour(),
                "chansonsbyid" => $chanson->getchansonInAlbum($_GET['id']), 
                "chansons" => $chanson->getChanson(), 
                "artistes" => $artiste->getArtistes(),
                "te" => $te->getPlaylistByUser(1), // ne marche pas
                "testPlaylist" => $te->getPlaylistById(1), // ça marche
                "playlist" => $te->getPlaylist(),
                "albumbyid" => $album->getAlbumById($_GET['id']), 
            ]);
        }
    }

    public function submitRetour()
    {
        $this->redirect("ControlleurHome", "view");
    }

    public function submitAjout()
    {
        $chanson = new DBPlaylist();
        $chanson->getPlaylistByUser($_SESSION['auth']);
        $idchanson = $_POST['id'];
        $idplaylist = $_POST['name'];
        $chanson->addChansonToPlaylist(1, 1); // a changer
       
        $this->redirect("ControlleurHome", "view");
    }


    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurMusique&action=submit", Form::GET, "musique_form");
        $form->setController("ControlleurMusique", "submitRetour");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }

    public function getFormAjout($id){ // ne veut pas mettre la méthode dans la page musique.php
        $forms = new Form("/?controller=ControlleurMusique&action=submit", Form::POST, "musique_form");
        $forms->setController("ControlleurMusique", "submitAjout");
        $forms->addInput(new Submit("Ajouter", true, $_SESSION["playlists"][0]["idutilisateur"], $id));
        return $forms;
    }

}