<?php

class Database{
    
    public static $host = "localhost";
    public static $database = "avancedtodo";
    public static $username = "root";
    public static $password = "";
    public $charset = "utf8mb4";
    private $conn;
    
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

