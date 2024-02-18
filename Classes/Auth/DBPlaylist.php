<?php

namespace Auth;

use data\Database;
use PDO;

class DBPlaylist{
    private $db;

  
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public static function registerPlaylist()
    {   
        $db = new DBPlaylist();
        $playlists = $db->db->query('SELECT * FROM PLAYLIST');
        return $playlists;
    }

    public static function getPlaylist(){
        $playlists = array();
        foreach(DBPlaylist::registerPlaylist() as $playlist){
            $playlists[] = array(
                'id_playlist' => $playlist->id_playlist,
                'nomplaylist' => $playlist->nomplaylist,
                "idutilisateur" => $playlist->idutilisateur
            );
        }
       
        return $playlists;
    }

    public static function getPlaylistById($id)
    {
        $db = new DBPlaylist();
        $playlistsArray = array();
        $stmt = $db->db->prepare('SELECT * FROM PLAYLIST WHERE id_playlist = ?', [$id]);
        $playlists = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($playlists){
            foreach($playlists as $playlist){
                $playlistsArray[] = array(
                    'id_playlist' => $playlist->id_playlist,
                    'nomplaylist' => $playlist->nomplaylist,
                    "idutilisateur" => $playlist->idutilisateur
                );
            }
            $_SESSION['playlists'] = $playlistsArray; 
        return $playlistsArray;
        }
        return false;
    }

    public function getPlaylistByUser($id)
    {
        $db = new DBPlaylist();

        $stmt = $db->db->prepare('SELECT * FROM PLAYLIST WHERE idutilisateur = ?', [$id]);
        $playlists = $stmt->fetchAll(PDO::FETCH_OBJ);
        $playlistsArray = array();
        if($playlists){
            foreach($playlists as $playlist){
                $playlistsArray[] = array(
                    'id_playlist' => $playlist->id_playlist,
                    'nomplaylist' => $playlist->nomplaylist,
                    "idutilisateur" => $playlist->idutilisateur
                );
            }
            $_SESSION['playlists'] = $playlistsArray;
            return $playlistsArray;
        }
        return false;
    }

    public function addPlaylist($nomplaylist, $idutilisateur)
    {
        $stmt = $this->db->prepare('INSERT INTO PLAYLIST (nomplaylist, idutilisateur) VALUES (?, ?)', [$nomplaylist, $idutilisateur]);
        return $stmt !== false;
    }

    public function deletePlaylist($id, $idutilisateur)
    {
        $stmt = $this->db->prepare('DELETE FROM PLAYLIST WHERE id_playlist = ? AND idutilisateur = ?', [$id, $idutilisateur]);
        return $stmt !== false;
    }

    public function updateNomPlaylist($id, $nomplaylist, $idutilisateur)
    {
        $stmt = $this->db->prepare('UPDATE PLAYLIST SET nomplaylist = ? WHERE id_playlist = ? AND idutilisateur = ? ', [$nomplaylist, $id, $idutilisateur]);
        return $stmt !== false;
    }

    public function getIdPlaylistByChanson($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM CONTENIR WHERE idchanson = ?', [$id]);
        $playlists = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($playlists){
            return $playlists;
        }
        return false;
    }

    public function addChansonToPlaylist($idchanson, $idplaylist)
    {
        $stmt = $this->db->prepare('INSERT INTO CONTENIR (id_playlist, idchanson) VALUES (?, ?)', [$idplaylist, $idchanson]);
        return $stmt !== false;
    }

    public function deleteChansonFromPlaylist($idchanson, $idplaylist)
    {
        $stmt = $this->db->prepare('DELETE FROM CONTENIR WHERE id_playlist = ? AND idchanson = ?', [$idplaylist, $idchanson]);
        return $stmt !== false;
    }

    public function getIdChansonInPlaylist($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM CONTENIR WHERE id_playlist = ?', [$id]);
        $chansons = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($chansons){
            return $chansons;
        }
        return false;
    }


    


}