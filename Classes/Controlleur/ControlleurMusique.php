<?php

namespace Controlleur;
use Auth\DBAlbum;
use Auth\DBArtiste;
use Auth\DBChanson;
use Auth\DBPlaylist;
use Controlleur\Controlleur;
use form\Form;
use form\type\Hidden;
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
        
        if (isset($_POST['album_id'])) {
            $chanson = new DBPlaylist();
            $idchanson = $_POST['album_id'];
            $chanson->getPlaylistByUser($_SESSION['auth']);
            $idplaylist = $_SESSION["playlists"][0]["idutilisateur"]; 
            $chanson->addChansonToPlaylist($idchanson, $idplaylist); 
            $this->redirect("ControlleurMusique", "view", $_SESSION["idPage"]);
        }
        else {
            echo "No album_id in POST data";
        }
    }

    public function getFormAjout($id){ 
        $forms = new Form("/?controller=ControlleurMusique&action=submitAjout", Form::POST, "musique_form");
        $forms->setController("ControlleurMusique", "submitAjout");
        $forms->addInput(new Hidden($id,true, "album_id", "album_id"));
        $forms->addInput(new Submit("Ajouter", true, "submit", "submit")); 
        return $forms;
    }

    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurMusique&action=submit", Form::GET, "musique_form");
        $form->setController("ControlleurMusique", "submitRetour");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }

    
    

}