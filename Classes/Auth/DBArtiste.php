<?php

namespace Auth;
use data\Database;
use PDO;

class DBArtiste{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public static function registerArtistes()
    {   
        $db = new DBArtiste();
        $artistes = $db->db->query('SELECT * FROM ARTISTE');
        return $artistes;
    }
    

    public static function getArtistes(){
        $artistes = array();
        foreach(DBArtiste::registerArtistes() as $art){
            $artistes[] = array(
                'idartiste' => $art->idartiste,
                'nom_artiste' => $art->nom_artiste,
                'prenom_artiste' => $art->prenom_artiste,
                'pseudo_artiste' => $art->pseudo_artiste,
            );
        }
        $_SESSION['artistes'] = $artistes;


        return $artistes;

    }

    public static function getArtisteById($id)
    {
        $db = new DBArtiste();
        $stmt = $db->db->prepare('SELECT * FROM ARTISTE WHERE idartiste = ?', [$id]);
        $artiste = $stmt->fetch(PDO::FETCH_OBJ);
        if($artiste){
            $artistes[] = array(
                'idartiste' => $artiste->idartiste,
                'nom_artiste' => $artiste->nom_artiste,
                'prenom_artiste' => $artiste->prenom_artiste,
                'pseudo_artiste' => $artiste->pseudo_artiste,
            );
            $_SESSION['idartiste'] = $artiste->idartiste;
            $_SESSION['nom_artiste'] = $artiste->nom_artiste;
            $_SESSION['prenom_artiste'] = $artiste->prenom_artiste;
            $_SESSION['pseudo_artiste'] = $artiste->pseudo_artiste;
            return $artistes;
        }
        return false;
    }

    public static function getArtisteByNom($nom)
    {
        $db = new DBArtiste();
        $stmt = $db->db->prepare('SELECT * FROM ARTISTE WHERE nom_artiste = ?', [$nom]);
        $artiste = $stmt->fetch(PDO::FETCH_OBJ);
        if($artiste){
            $artistes[] = array(
                'idartiste' => $artiste->idartiste,
                'nom_artiste' => $artiste->nom_artiste,
                'prenom_artiste' => $artiste->prenom_artiste,
                'pseudo_artiste' => $artiste->pseudo_artiste,
            );
            $_SESSION['idartiste'] = $artiste->idartiste;
            $_SESSION['nom_artiste'] = $artiste->nom_artiste;
            $_SESSION['prenom_artiste'] = $artiste->prenom_artiste;
            $_SESSION['pseudo_artiste'] = $artiste->pseudo_artiste;
            return $artistes;   
        }
        return false;
    }

    public function deleteArtiste($id)
    {
        $stmt = $this->db->prepare('DELETE FROM ARTISTE WHERE idartiste = ?', [$id]);
        return $stmt ? true : false;
    }

    public function updateArtiste($id, $pseudo)
    {
        $stmt = $this->db->prepare('UPDATE ARTISTE SET pseudo_artiste = ? WHERE idartiste = ?', [$pseudo, $id]);

        return $stmt ? true : false;
    }

}