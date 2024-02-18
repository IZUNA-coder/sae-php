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
            $artiste = DBArtiste::getArtistes();

            $this->render("album.php", [ 
                "formRetour" => $this->getFormRetour(),
                "nom_album" => $_SESSION['titre'] ?? "aucun album",
                "anneeAlbum" => $_SESSION['annee_album'] ?? "aucune annee",
                "imageAlbum" => $_SESSION['image_album'] ?? "aucune image",
                "albums" => $albums,
                "albums2" => $albums,
                "artiste" => $artiste ?? "aucun artiste",
                "dbAlbum" => new DBAlbum(),
            ]);

        }
    }

    public function submit()
    {
        $this->redirect("ControlleurHome", "view");
    }

    public function submitListeAlbum()
    {
        $this->redirect("ControlleurAlbum", "view");
    }
    
    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurAlbum&action=submit", Form::GET, "album_form");
        $form->setController("ControlleurAlbum", "submit");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }

    

    public function submitDelete()
    {
    
     if (isset($_POST['album_id'])) {
      $id = $_POST['album_id'];
      $album = new DBAlbum();
      $album->deleteAlbum($id); 
      $_SESSION["idAlbumSupprimer"] = $id;
      $this->redirect("ControlleurAlbum", "view");
     } else {
      echo "No album_id in POST data";
     }
    }

public function getFormDeleteAdmin($id){ 
    $forms = new Form("/?controller=ControlleurAlbum&action=submitDelete", Form::POST, "musique_form");
    $forms->setController("ControlleurAlbum", "submitDelete");
    $forms->addInput(new Hidden($id,true, "album_id", "album_id")); 
    $forms->addInput(new Submit("Supprimer", true, "", "", ""));
    
    return $forms;
    }

    

    public function getFormAddAdmin($id){
        $forms = new Form("/?controller=ControlleurAlbum&action=submit", Form::GET, "musique_form");
        $forms->setController("ControlleurAlbumArtiste", "submit");
        $forms->addInput(new Hidden($id,true, "album_id", "album_id")); 
        $forms->addInput(new Submit("Ajouter", true, "album_id", ""));
        
        
        return $forms; 
    }
   
    public function getFormModifier(){
        $form = new Form("/?controller=ControlleurModifier&action=submit", Form::GET, "modifier_form");
        $form->setController("ControlleurModifier", "submit");
        $form->addInput(new Submit("Modifier", true, "modifier", "modifierId", "confirmAction()"));
        return $form;
    }

    public function getFormLink($idalbum){
        $form = new Form("/?controller=ControlleurAlbum&action=view", Form::GET, "modifier_form");
        $form->addInput(new Link("/?controller=ControlleurModifier&action=view&id={$idalbum}", "Modifier"));
        return $form;
    }


}