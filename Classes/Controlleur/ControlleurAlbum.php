<?php
namespace Controlleur;

use Auth\DBAlbum;
use Auth\DBArtiste;
use form\Form;
use form\type\Hidden;
use form\type\Link;
use form\type\Submit;

class ControlleurAlbum extends Controlleur
{
    public function view()
    {
    $albums = DBAlbum::getAlbums();
        
        if(!isset($_SESSION['auth'])){
            $this->redirect("ControlleurLogin", "view");
        }else{
            $albums = DBAlbum::getAlbums();
            $artistes = DBArtiste::getArtistes();
            $formLinks = [];

            foreach($albums as $album) {
                foreach($artistes as $artiste) {
                    if ($artiste['idartiste'] == $album['idartiste']) {
                        $formLinks[$album['idartiste']] = $this->getFormLink($artiste['idartiste']);
                        break;
                    }
                }
            }

            $this->render("album.php", [ 
                //"form" => $this->getFormRetour(),
                "nom_album" => $_SESSION['titre'] ?? "aucun album",
                "anneeAlbum" => $_SESSION['annee_album'] ?? "aucune annee",
                "imageAlbum" => $_SESSION['image_album'] ?? "aucune image",
                "albums" => $albums,
                "albumsbyid" => $albums,

                
            ]);

        }
    }

    public function submit()
    {
        $this->redirect("ControlleurHome", "view");
    }

    

    //public function getFormRetour()
    //{
    //    $form = new Form("/?controller=ControlleurAlbum&action=submit", Form::GET, "album_form");
    //    $form->setController("ControlleurAlbum", "submit");
    //    $form->addInput(new Submit("Retour", true, "", ""));
    //    return $form;
    //}

    public function submitDelete()
{

    if (isset($_POST['album_id'])) {
        $id = $_POST['album_id'];
        $album = new DBAlbum();
        $album->deleteAlbum($id); 
        $this->redirect("ControlleurHome", "view");
    } else {
        echo "No album_id in POST data";
    }
}

    public function getFormDelete($id){ 
        $forms = new Form("/?controller=ControlleurAlbum&action=submitDelete", Form::POST, "musique_form");
        $forms->setController("ControlleurAlbum", "submitDelete");
        $forms->addInput(new Hidden($id,true, "album_id", "album_id"));
        $forms->addInput(new Submit("Supprimer", true, $id, $id));
        
        return $forms;
    }

    public function getFormLink($idartiste){
        $form = new Form("/?controller=ControlleurHome&action=view", Form::GET, "home_form");
        $form->setController("ControlleurHome", "submit");
        $form->addInput(new Link("/?controller=ControlleurAlbum&action=view&id={$idartiste}", "Supprimer"));
        return $form;
    }




}