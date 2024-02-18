<?php
namespace Controlleur;

use Auth\DBAlbum;
use Auth\DBArtiste;
use form\Form;
use form\type\Hidden;
use form\type\Link;
use form\type\Submit;

class ControlleurArtiste extends Controlleur
{
    public function view()
    {
        
        if(!isset($_SESSION['auth'])){
            $this->redirect("ControlleurLogin", "view");
        }else{
            $artistes = DBArtiste::getArtistes();

            $this->render("artiste.php", [ 
                "formRetour" => $this->getFormRetour(),
                "artistes" => $artistes,
            ]);

        }
    }

    public function submit()
    {
        $this->redirect("ControlleurArtiste", "view");
    }

    public function submitListeAlbum()
    {
        $this->redirect("ControlleurArtiste", "view");
    }
    
    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurArtiste&action=submit", Form::GET, "album_form");
        $form->setController("ControlleurHome", "view");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }

    

    public function submitDelete()
    {
    
     if (isset($_POST['artiste_id'])) {
      $id = $_POST['artiste_id'];
      $album = new DBArtiste();
      $album->deleteArtiste($id); 
      $_SESSION["idArtisteSupprimer"] = $id;
      $this->redirect("ControlleurArtiste", "view");
     } else {
      echo "No artiste_id in POST data";
     }
    }

public function getFormDeleteAdmin($id){ 
    $forms = new Form("/?controller=ControlleurArtiste&action=submitDelete", Form::POST, "musique_form");
    $forms->setController("ControlleurArtiste", "submitDelete");
    $forms->addInput(new Hidden($id,true, "artiste_id", "artiste_id")); 
    $forms->addInput(new Submit("Supprimer", true, "", "", ""));
    
    return $forms;
    }

    

    public function getFormAddAdmin($id){
        $forms = new Form("/?controller=ControlleurArtiste&action=submit", Form::GET, "musique_form");
        $forms->setController("ControlleurArtisteAjouter", "submit");
        $forms->addInput(new Hidden($id,true, "artiste_id", "artiste_id"));
        $forms->addInput(new Submit("Ajouter", true, "artiste_id", ""));
       
       
        return $forms;
    }
   
    public function getFormModifier(){
        $form = new Form("/?controller=ControlleurArtisteModifier&action=submit", Form::GET, "modifier_form");
        $form->setController("ControlleurArtisteModifier", "submit");
        $form->addInput(new Submit("Modifier", true, "modifier", "modifierId"));
        return $form;
    }

    public function getFormLink($idartiste){
        $form = new Form("/?controller=ControlleurArtiste&action=view", Form::GET, "modifier_form");
        $form->addInput(new Link("/?controller=ControlleurArtisteModifier&action=view&id={$idartiste}", "Modifier"));
        return $form;
    }



}