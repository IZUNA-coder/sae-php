<?php 

namespace data;

use PDO;
use PDOStatement;
use PDOException;

class Database{

    private PDO $db;

    private static $instance = null;

    public function __construct() {
        try {
            $this->db = new PDO('sqlite:sound.sqlite3');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function getPDO() {
        return $this->db;
    }

    /**
     * @param string $query
     * @return ?PDOStatement
     */
    public function query(string $query){
        $requete = $this->getPDO()->query($query);
        $datas = $requete->fetchAll(PDO::FETCH_OBJ);
        return $datas;
    }


    public function prepare(string $query, array $params){
        $requete = $this->getPDO()->prepare($query);
        $requete->execute($params);
        
        return $requete;
    } 

    public function execute(string $query){
        try {
            $this->getPDO()->exec($query);
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    
    /**
     * @return void
     */
    public function close(): void{
        $this->db = null;
    }

    /**
     * @return Database
     */
    public static function getInstance(): self{
        if(self::$instance === null){
            self::$instance = new Database();
        }
        return self::$instance;
    }
}