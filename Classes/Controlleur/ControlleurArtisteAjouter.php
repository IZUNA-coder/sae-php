<?php
namespace Controlleur;

use Auth\DBAlbum;
use Auth\DBArtiste;
use form\Form;
use form\FormData;
use form\type\Checkbox;
use form\type\File;
use form\type\Submit;
use form\type\Text;
use form\type\Number;


class ControlleurArtisteAjouter extends Controlleur
{
    public function view()
    {
        $dbartiste = new DBArtiste();
       
        if(!isset($_SESSION['auth'])){
            $this->redirect("ControlleurLogin", "view");
        }else{
            $this->render("artisteajouter.php", [
                "formRetour" => $this->getFormRetour(),
                "formAjouter" => $this->getFormAjouter(),
                "dbArtiste" => new DBArtiste(),
                "artiste" => $dbartiste->getArtisteById($_GET['id']),
            ]);
        }
    }


    public function submit()
    {
       
        $this->redirect("ControlleurArtisteAjouter", "view");
    }
   
    public function submitAdd(){
        $dbArtiste = new DBArtiste();
        $dbArtiste->addArtiste($_POST['pseudo']);
        $this->redirect("ControlleurArtiste", "view", $_SESSION['id_artiste_choisi']);
        }
    
    public function submitRetour()
    {
        $this->redirect("ControlleurArtiste", "view");
    }


    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurArtisteAjouter&action=submit", Form::GET, "album_form");
        $form->setController("ControlleurArtisteAjouter", "submitRetour");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }


    public function getFormAjouter()
    {  
        $dbArtiste = DBArtiste::getArtistes();

    


        $form = new Form("/?controller=ControlleurArtisteAjouter&action=submitAdd", Form::POST, "addArtisteForm");
        $form->setController("ControlleurArtisteAjouter", "submitAdd");
        $form->addInput((new Text("", true,"pseudo", "pseudo"))->setLabel("Pseudo Artiste "));
        $form->addInput(new Submit("Ajouter", true, "", ""));    

        return $form;
    }


    public function getFormAjouter2()
    {  
        $dbArtiste = new DBAlbum();
        $genre = $dbArtiste->getGenresAlbum();


        $form = new FormData("/?controller=ControlleurArtisteAjouter&action=submitAdd", Form::POST, "addAlbumForm", 'validateForm', "onsubmit");


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
