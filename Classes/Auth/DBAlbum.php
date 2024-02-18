<?php

namespace Auth;
use data\Database;
use PDO;

class DBAlbum{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public static function registerAlbums()
    {   
        $db = new DBAlbum();
        $albums = $db->db->query('SELECT * FROM ALBUM');
        return $albums;
    }

    public static function getAlbums()
    {
        $albums = array();
        foreach(DBAlbum::registerAlbums() as $alb){
            $albums[] = array(
                'idalbum' => $alb->idalbum,
                'nom_album' => $alb->nom_album,
                'annee_album' => $alb->annee_album,
                'idartiste' => $alb->idartiste,
                'image_album' => $alb->image_album,
            );
        
        }
        $_SESSION['album'] = $albums;
        return $albums;
    }

    
    public function getAlbumById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM ALBUM WHERE idalbum = ?', [$id]);
        $album = $stmt->fetch(PDO::FETCH_OBJ);
        if($album){
            $_SESSION['idalbum'] = $album->idalbum;
            $_SESSION['titre'] = $album->nom_album;
            $_SESSION['annee_album'] = $album->annee_album;
            $_SESSION['image_album'] = $album->image_album;
            return $album;
        }
        return false;
    }

    public function getAlbumsByArtiste($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM ALBUM WHERE idartiste = ?', [$id]);
        $albums = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($albums){
            $albumsArray = array();
            foreach($albums as $album){
                $albumsArray[] = array(
                    'idalbum' => $album->idalbum,
                    'titre' => $album->nom_album,
                    'annee_album' => $album->annee_album,
                    'image_album' => $album->image_album,

                );
            }
            $_SESSION['albums'] = $albumsArray;
            return $albumsArray;
        }
        return false;
    }


    public function getAlbumsByTitre($titre)
    {
        $stmt = $this->db->prepare('SELECT * FROM ALBUM WHERE nom_album = ?', [$titre]);
        $album = $stmt->fetch(PDO::FETCH_OBJ);
        if($album){
            $_SESSION['idalbum'] = $album->idalbum;
            $_SESSION['titre'] = $album->nom_album;
            $_SESSION['annee_album'] = $album->annee_album;
            $_SESSION['image_album'] = $album->image_album;
            return $album;
        }
        return false;
    }

    public function getAlbumsByAnnee($annee)
    {
        $stmt = $this->db->prepare('SELECT * FROM ALBUM WHERE annee_album = ?', [$annee]);
        $albums = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($albums){
            $albumsArray = array();
            foreach($albums as $album){
                $albumsArray[] = array(
                    'idalbum' => $album->idalbum,
                    'titre' => $album->nom_album,
                    'annee_album' => $album->annee_album,
                    'image_album' => $album->image_album,

                );
            }
            if(isset($_SESSION['albums'])){
                $_SESSION['albums'] = array_merge($_SESSION['albums'], $albumsArray);
            }
            else{
                $_SESSION['albums'] = $albumsArray;
            }
            return $albumsArray;
        }
        return false;
    }



    public function addAlbum($titre, $annee, $idartiste, $image)
    {
        if (!preg_match('/^\.\/data\//', $image)) {
            $image = 'data/images/default.jpg';
        }

        $stmt = $this->db->prepare('INSERT INTO ALBUM (nom_album, annee_album, image_album, idartiste) VALUES (?, ?, ?, ?)', [$titre, $annee, $image, $idartiste]);
        return $stmt !== false;
    }


    public function updateAlbum($id, $titre, $annee, $image)
    {
        $stmt = $this->db->prepare('UPDATE ALBUM SET nom_album = ?, annee_album = ?, image_album = ? WHERE idalbum = ?', [$titre, $annee, $image, $id]);
        return $stmt !== false;
    }

    public function updateAlbumTitre($id, $titre)
    {
        $stmt = $this->db->prepare('UPDATE ALBUM SET nom_album = ? WHERE idalbum = ?', [$titre, $id]);
        return $stmt !== false;
    }
    
    public function deleteAlbum($id)
    {
        $stmt = $this->db->prepare('DELETE FROM ALBUM WHERE idalbum = ?', [$id]);
        return $stmt !== false;
    }
    
    public function getGenreAlbumbyId($idalbum){
        $stmt = $this->db->prepare('SELECT * FROM APPARTENIR_ALBUM INNER JOIN GENRE ON APPARTENIR_ALBUM.idgenre = GENRE.idgenre WHERE idalbum = ?', [$idalbum]);
        $genres = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($genres){
            $genresArray = array();
            foreach($genres as $genre){
                $genresArray[] = array(
                    'idgenre' => $genre->idgenre,
                    'nom_genre' => $genre->nomgenre,
                );
            }
            $_SESSION['genres'] = $genresArray;
            return $genresArray;
        }
        return false;
    }

    public function getGenresAlbum(){
        $genres = $this->db->query('SELECT * FROM GENRE');
        if($genres){
            $genresArray = array();
            foreach($genres as $genre){
                $genresArray[] = array(
                    'idgenre' => $genre->idgenre,
                    'nom_genre' => $genre->nomgenre,
                );
            }
            $_SESSION['genres'] = $genresArray;
            return $genresArray;
        }
        return false;
    }   

    public function addGenreAlbum($idalbum, $idgenre){
        $stmt = $this->db->prepare('SELECT * FROM APPARTENIR_ALBUM WHERE idalbum = ? AND idgenre = ?', [$idalbum, $idgenre]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$result) {
            $stmt = $this->db->prepare('INSERT INTO APPARTENIR_ALBUM (idalbum, idgenre) VALUES (?, ?)', [$idalbum, $idgenre]);
        }
    
        return $stmt !== false;
    }
    

    public function getGenreId($nomGenre){
        $stmt = $this->db->prepare('SELECT idgenre FROM GENRE WHERE nomgenre = ?', [$nomGenre]);
        $genre = $stmt->fetch(PDO::FETCH_OBJ);
        return $genre ? $genre->idgenre : false;
    }
    

}