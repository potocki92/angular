<?php
class Database {
    private $host = 'localhost';
    private $db = 'todo_db';
    private $username = 'root';
    private $password = 'root';

    public $conn;

    public function getConnection(){
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception){
            echo "Database not connected: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
