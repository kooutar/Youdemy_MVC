<?php

class database {
    private static ?database $instance = null; 
    private PDO $connection; 

    private function __construct() {

        $dsn = 'pgsql:host=localhost;dbname=yoydemy';
        $username = 'postgres';
        $password = 'kaoutar';
        try {
            $this->connection = new PDO(
                $dsn,
                $username,
                $password,
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        } catch (PDOException $e) {
            throw new Exception("Erreur de connexion : " . $e->getMessage());
        }
    }

   
    public static function getInstance(): database {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function getConnection(): PDO {
        return $this->connection;
    }
}
