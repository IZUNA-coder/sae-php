<?php

namespace Controlleur;

use Auth\DBAlbum;
use form\Form;
use form\type\Checkbox;
use form\type\Submit;
use form\type\Text;

class ControlleurModifier extends Controlleur{

    public function view(){
        $dbAlbum = DBAlbum::getAlbums();
        $this->render("modifierAdmin.php", ["form" => $this->getForm(), 
        'dbAlbum' => $dbAlbum,
        "formRetour" => $this->getFormRetour(),
        ]);
        
        }     
    
    public function submit(){
        $db = new DBAlbum();
        $db->updateAlbum($_SESSION['idalbum'],$_POST['nom_album'], $_POST['annee_album'], $_POST['genre'] );
        $this->redirect("ControlleurAlbum", "view");
    }
 
    private function getForm(){
        $form = new Form("/?controller=ControlleurModifier&action=submit", Form::POST, "login_form", 'validateForm', "onsubmit");
        $dbAlbum = DBAlbum::getAlbums();
        $dbGenre = new DBAlbum();

        $allGenres = $dbGenre->getGenresAlbum(); 
        foreach($dbAlbum as $album){
            if($album['idalbum'] == $_GET['id']){
                $form->addInput((new Text($album['nom_album'], true,"nom_album", "album_id"))->setLabel("Nom album"));
                $form->addInput((new Text($album['annee_album'], true,"annee_album", "annee_id"))->setLabel("annee album"));

                foreach($allGenres as $g){
                    $dejaSelectionne = $dbGenre->getGenreAlbum($_GET['id'], $g['idgenre']);
                    if($dejaSelectionne){
                        $form->addInput((new Checkbox($g["nom_genre"], false, "genre[]", "genre","", $g["nom_genre"], '', true)));
                        $genreArray[] = $g["nom_genre"];
                    }else{
                        $form->addInput((new Checkbox($g["nom_genre"], false, "genre[]", "genre","", $g["nom_genre"])));
                    }
                }
            }
        }

        $_SESSION['genreSelectionne'] = $genreArray;
        $form->addInput(new Submit("Modifier", true, "", ""));
        $form->setController("ControlleurModifier", "submit");
        return $form;
    }
        
    
    public function getFormRetour()
    {
        $form = new Form("/?controller=ControlleurAlbumAjouter&action=submit", Form::GET, "album_form");
        $form->setController("ControlleurAlbum", "submitListeAlbum");
        $form->addInput(new Submit("Retour", true, "", ""));
        return $form;
    }

}