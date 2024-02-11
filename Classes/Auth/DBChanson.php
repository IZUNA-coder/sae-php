<?php

namespace Auth;

use data\Database;
use PDO;

class DBChanson{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public static function registerChansons()
    {   
        $db = new DBChanson();
        $chansons = $db->db->query('SELECT * FROM CHANSON');
        return $chansons;
    }
    

    public static function getChanson(){
        $chansons = array();
        foreach(DBChanson::registerChansons() as $chanson){
            $chansons[] = array(
                'idchanson' => $chanson->idchanson,
                'nom_chanson' => $chanson->nom_chanson,
                'duree_chanson' => $chanson->duree_chanson,
            );
        }
        $_SESSION['chansons'] = $chansons;
        return $chansons;
    }

    public static function getchansonById($id)
    {
        $db = new DBChanson();
        $chansonsArray = array();

        $stmt = $db->db->prepare('SELECT * FROM CHANSON WHERE idchanson = ?', [$id]);
        $chansons = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($chansons){
            foreach($chansons as $chanson){
                $chansonsArray[] = array(
                    'idchanson' => $chanson->idchanson,
                    'nom_chanson' => $chanson->nom_chanson,
                    'duree_chanson' => $chanson->duree_chanson,
                );
            }
            $_SESSION['chansons'] = $chansonsArray;
            return $chansonsArray;
        }
        return false;
    }

    public function getchansonInAlbum($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM CONTENIR_ALBUM WHERE idalbum = ?', [$id]);
        $chansons = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($chansons){
            $_SESSION['chansons'] = $chansons;
            return $chansons;
        }
        return false;
    }
}