<?php

namespace Auth;

use data\Database;
use PDO;

class DBAuth
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getUserId()
    {
        if ($this->logged()) {
            return $_SESSION['auth'];
        }
        return false;
    }

    public function login($username, $password)
{
    $stmt = $this->db->prepare('SELECT * FROM UTILISATEUR WHERE pseudo = ?', [$username]);
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    
    if($user){
        if($user->mdp === $password){
            $_SESSION['auth'] = $user->idutilisateur;
            $_SESSION['pseudo'] = $user->pseudo;
            $_SESSION['email'] = $user->email;
            $_SESSION['nom'] = $user->nom;
            $_SESSION['prenom'] = $user->prenom;
            $_SESSION['mdp'] = $user->mdp;
            return $user;
        }
    }
    
    return false;
}

    public function logged()
    {
        return isset($_SESSION['auth']);
    }

    public function logout()
    {
        session_destroy();
        
    }
}