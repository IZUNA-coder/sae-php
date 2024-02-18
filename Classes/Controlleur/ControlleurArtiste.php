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
    $artistes = DBArtiste::getArtistes();
        
        if(!isset($_SESSION['auth'])){
            $this->redirect("ControlleurLogin", "view");
        }else{
            $artistes = DBArtiste::getArtistes();

            $this->render("artiste.php", [ 
                "formRetour" => $this->getFormRetour(),
                "nom_artiste" => $_SESSION['nom_artiste'] ?? "aucun artiste",
                "prenom_artiste" => $_SESSION['prenom_artiste'] ?? "aucun prenom",
                "pseudo_artiste" => $_SESSION['pseudo_artiste'] ?? "aucun pseudo",
                "artistes" => $artistes,
            ]);

        }
    }

    public function submit()
    {
        $this->redirect("ControlleurHome", "view");
    }

    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurArtiste&action=submit", Form::GET, "Artiste_form");
        $form->setController("ControlleurArtiste", "submit");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }

    public function submitDelete()
{

    if (isset($_POST['Artiste_id'])) {
        $id = $_POST['Artiste_id'];
        $Artiste = new DBArtiste();
        $Artiste->deleteArtiste($id); 
        $_SESSION["idArtisteSupprimer"] = $id;
        $this->redirect("ControlleurArtiste", "view");
    } else {
        echo "No Artiste_id in POST data";
    }
}

    public function getFormDeleteAdmin($id){ 
        $forms = new Form("/?controller=ControlleurArtiste&action=submitDelete", Form::POST, "musique_form");
        $forms->setController("ControlleurArtiste", "submitDelete");
        $forms->addInput(new Hidden($id,true, "Artiste_id", "Artiste_id")); 
        $forms->addInput(new Submit("Supprimer", true, "Artiste_id", "", "confirmAction()"));
        
        return $forms;
    }

    public function getFormAddAdmin($id){
        $forms = new Form("/?controller=ControlleurArtisteAjouter&action=submit", Form::POST, "musique_form");
        $forms->setController("ControlleurArtisteAjouter", "submit");
        $forms->addInput(new Hidden($id,true, "Artiste_id", "Artiste_id")); 
        $forms->addInput(new Submit("Ajouter", true, "Artiste_id", ""));
        
        return $forms; 
    }

   




}