<?php
namespace Controlleur;

use Auth\DBAlbum;
use form\Form;
use form\type\File;
use form\type\Hidden;
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
        
        $this->redirect("ControlleurAlbum", "view");
    }
    
    public function submitAdd(){
        $dbAlbum = new DBAlbum();
        $_SESSION["titre"]= $_POST['titre'];
        $_SESSION["annee_album"]= $_POST['annee_album'];
        $_SESSION["Image"]= $_FILES['image']['tmp_name'];
        $dbAlbum->addAlbum($_POST['titre'], $_POST['annee_album'], $_SESSION['id_artiste_choisi'], $_POST['Image']);        
        $this->redirect("ControlleurAlbumAjouter", "view", $_SESSION['id_artiste_choisi']);
    }

    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurAlbumAjouter&action=submit", Form::GET, "album_form");
        $form->setController("ControlleurAlbum", "submitListeAlbum");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }

    public function getFormAjouter()
    {
        $form = new Form("/?controller=ControlleurAlbumAjouter&action=submitAdd", Form::POST, "album_form");
        $form->addInput((new Text("", true,"titre", "titre"))->setLabel("Titre Album"));
        $form->addInput((new Text("", true,"annee_album", "annee_album"))->setLabel("Annee Album"));
        $form->addInput(new File("Image", true, "Image",'Image', "Image de l'album"));
        $form->addInput(new Submit("Ajouter", true, "", ""));    
        return $form;
    }
    
}