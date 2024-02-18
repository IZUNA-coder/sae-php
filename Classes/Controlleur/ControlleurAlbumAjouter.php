<?php
namespace Controlleur;

use Auth\DBAlbum;
use Auth\DBArtiste;
use form\Form;
use form\FormData;
use form\type\Checkbox;
use form\type\File;
use form\type\Hidden;
use form\type\RadioButton;
use form\type\Submit;
use form\type\Text;
use form\type\Number;

class ControlleurAlbumAjouter extends Controlleur
{
    public function view()
    {
        $dbartiste = new DBArtiste();
        
        if(!isset($_SESSION['auth'])){
            $this->redirect("ControlleurLogin", "view");
        }else{
            $this->render("albumajouter.php", [ 
                "formRetour" => $this->getFormRetour(),
                "formAjouter" => $this->getFormAjouter(),
                "dbAlbum" => new DBAlbum(),
                "artiste" => $dbartiste->getArtisteById($_GET['id']),
            ]);
        }
    }

    public function submit()
    {
        
        $this->redirect("ControlleurAlbum", "view");
    }
    
    public function submitAdd(){
        $dbAlbum = new DBAlbum();
        $albums = DBAlbum::getAlbums();
        $_SESSION["titre"]= $_POST['titre'];
        $_SESSION["annee_album"]= $_POST['annee_album'];
        $_SESSION["Image"]= $_FILES['image']['tmp_name'];
        
        $dbAlbum->addAlbum($_POST['titre'], $_POST['annee_album'], $_SESSION['id_artiste_choisi'], $_POST['Image']); 
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['genre'])) {
            $idalbum = end($albums)["idalbum"]+1;

            foreach ($_POST['genre'] as $nomGenre) {
                $idGenre = $dbAlbum->getGenreId($nomGenre);
                $dbAlbum->addGenreAlbum($idalbum, $idGenre);
            }
        } 
        $this->redirect("ControlleurAlbum", "view", $_SESSION['id_artiste_choisi']);
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
        $dbAlbum = new DBAlbum();
        $genre = $dbAlbum->getGenresAlbum();

        $form = new FormData("/?controller=ControlleurAlbumAjouter&action=submitAdd", Form::POST, "addAlbumForm", 'validateForm', "onsubmit");

        $form->addInput((new Text("", true,"titre", "titre"))->setLabel("Titre Album"));
        $form->addInput((new Number("", true,"annee_album", "annee_album"))->setLabel("Annee Album"));
        $form->addInput(new File("Image", true, "Image",'Image', "Image de l'album"));
        foreach($genre as $g){
            $form->addInput((new Checkbox($g["nom_genre"], false, "genre[]", "genre","", $g["nom_genre"])));
        }
        $form->addInput(new Submit("Ajouter", true, "", ""));    


        return $form;
    }
    

}

