<?php
class Database {
    private $host = "localhost";
    private $db_name = "hospital";
    private $username = "root"; 
    private $password = ""; 
    private $conn;

    private $pdo;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Modo de error de PDO
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=hospital", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function prepare($query) {
        return $this->pdo->prepare($query);
    }
    
}
?>