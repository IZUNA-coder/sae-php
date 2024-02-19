<?php
namespace Controlleur;

use Auth\DBAlbum;
use Auth\DBArtiste;
use Auth\DBAuth;
use form\Form;
use form\type\Link;
use form\type\Select;
use form\type\Submit;
use form\type\Text;

class ControlleurHome extends Controlleur
{
   
    public function view()
    {
        if(!isset($_SESSION['auth'])){
            $this->redirect("ControlleurLogin", "view");
        } else {
            $albums = DBAlbum::getAlbums();
            $artistes = DBArtiste::getArtistes();
            $formLinks = [];
        

            foreach($albums as $album) {
                foreach($artistes as $artiste) {
                    if ($artiste['idartiste'] == $album['idartiste']) {
                        $formLinks[$album['idalbum']] = $this->getFormLink($album['idalbum']);
                        break;
                    }
                }
            }

            if($_SESSION['id_role'] == 1){
                $this->render("main.php", [
                    "formRetour" => $this->getFormDeconnexion(),
                    "utilisateur" => $_SESSION['pseudo'] ?? "aucun",
                    "email" => $_SESSION['email'],
                    "nom" => $_SESSION['nom'],
                    "prenom" => $_SESSION['prenom'],
                    "mdp" => $_SESSION['mdp'],
                    "formRegister" => $this->getFormRegister(),
                    "formAdminAlbum" => $this->getFormAdminAlbum(),
                    "formAdminArtiste" => $this->getFormAdminArtiste(),
                ]);
            }else{
                $this->render("main.php", [
                    "formRetour" => $this->getFormDeconnexion(),
                    "utilisateur" => $_SESSION['pseudo'] ?? "aucun",
                    "email" => $_SESSION['email'],
                    "nom" => $_SESSION['nom'],
                    "prenom" => $_SESSION['prenom'],
                    "mdp" => $_SESSION['mdp'],
                    "artistes" => $artistes,
                    "albums" => $albums,
                    "formLinks" => $formLinks,
                    "selectGenre" => $this->getSelectGenre(),
                    "dbAlbum" => new DBAlbum(),
                    "formRecherche" => $this->getFormRecherche(),
                    "selectAnnee" => $this->getSelectAnnee(),
                    "selectArtiste" => $this->getSelectArtiste(),
                    "formPlaylist" => $this->getFormPlaylist(),
            ]);
        }
        }
    }

    public function submit()
    {
        $auth = new DBAuth();
        $auth->logout();
        $this->redirect("ControlleurLogin", "view");
    }

    public function getFormDeconnexion()
    {
        $form = new Form("/?controller=ControlleurHome&action=submit", Form::GET, "home_form");
        $form->setController("ControlleurHome", "submit");


        $form->addInput(new Submit("Deconnexion", true, "", ""));
        return $form;
    }

    public function getFormRegister()
    {   
        $form = new Form("/?controller=ControlleurHome&action=view", Form::GET, "home_form");
        $form->setController("ControlleurHome", "submit");
        $form->addInput(new Link("/?controller=ControlleurRegister&action=view", "Register"));
        return $form;
    }
  

    public function getFormLink($idartiste){
        $form = new Form("/?controller=ControlleurHome&action=view", Form::GET, "home_form");
        $form->setController("ControlleurHome", "submit");
        $form->addInput(new Link("/?controller=ControlleurMusique&action=view&id={$idartiste}", "En voir plus"));
        return $form;
    }

    public function getFormAdminAlbum(){
        $form = new Form("/?controller=ControlleurHome&action=view", Form::GET, "home_form");
        $form->setController("ControlleurHome", "submit");
        $form->addInput(new Link("/?controller=ControlleurAlbum&action=view", "Albums"));
        return $form;
    }

    public function getFormAdminArtiste(){
        $form = new Form("/?controller=ControlleurHome&action=view", Form::GET, "home_form");
        $form->setController("ControlleurHome", "submit");
        $form->addInput(new Link("/?controller=ControlleurArtiste&action=view", "Artistes"));
        return $form;
    }

    public function getSelectGenre(){
        $select = new Select('genreSelect', true, "", "genreSelect", "filtrages()","", "onchange");
        $select->addOption('', 'Tous les genres');
        $dbAlbum = new DBAlbum();
        $genres = $dbAlbum->getGenresAlbum();
        foreach($genres as $genre){
            $select->addOption($genre['nom_genre'], $genre['nom_genre']);
        }   
        return $select;
    }

    public function getSelectAnnee(){
        $select = new Select('anneeSelect', true, "", "anneeSelect", "filtrages()","", "onchange");
        $select->addOption('', 'Toutes les années');
        $dbAlbum = new DBAlbum();
        $annees = $dbAlbum->getAnneesAlbum();
        foreach($annees as $annee){
            $select->addOption($annee['annee_album'], $annee['annee_album']);
        }   
        return $select;
    }

    public function getSelectArtiste(){
        $select = new Select('artisteSelect', true, "", "artisteSelect", "filtrages()","", "onchange");
        $select->addOption('', 'Tous les artistes');
        $dbArtiste = new DBArtiste();
        $artistes = $dbArtiste->getArtistes();
        foreach($artistes as $artiste){
            $select->addOption($artiste['pseudo_artiste'], $artiste['pseudo_artiste']);
        }   
        return $select;
    }

    public function getFormRecherche(){
        $form = new Form("/?controller=ControlleurHome&action=view", "", "home_form");
        $form->addInput(new Text("", true, "recherche", "recherche", "filtrages()", "", "oninput"));
        return $form;
    }

    public function getFormPlaylist(){
        $form = new Form("/?controller=ControlleurPlaylist&action=view", Form::GET, "playlist_form");
        $form->setController("ControlleurPlaylist", "submit");
        $form->addInput(new Submit("Playlist", true, "", ""));
        return $form;
    }
}