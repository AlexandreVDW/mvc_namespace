<?php 
declare(strict_types = 1);

namespace App\Models;

class DatabaseManager {
    private $pdo;

    public function __construct() {
        require './Helpers/log.php';

        try {
            $this->pdo = new \PDO(
                'mysql:host=localhost;dbname=mvc;charset=utf8',
                $login, 
                $password
            );
        } catch(Exception $e) {
            die('Erreur : '.$e->getMessage());
        }
    }

    public function query($sql) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getPdo() {
        return $this->pdo;
    }
}