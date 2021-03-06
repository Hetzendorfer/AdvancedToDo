<?php

class Database{
    
    private $host = "localhost";
    private $db_name = "atd";
    private $username = "root";
    private $password = "";
    private $charset = "utf8mb4";
    public $conn;
    
    public function getConnection() {
        $this->conn = null;
        
        $dsn = "mysql:host=$this->host;dbname=$this->db_name;charset=$this->charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        try{
            $this->conn = new PDO($dsn, $this->username, $this->password, $opt);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
            $this->conn = null;
        }
        
        return $this->conn;
    }
}

