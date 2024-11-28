<?php
class Usuario {
    private $id_usuario;
    private $username;
    private $password;
    private $cedula;
    private $email;
    private $conn; 
    private $table = 'usuarios'; 

    
    public function __construct($db) {
        $this->conn = $db;
    }

    // Getters y Setters
    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

 
    public function setPassword($password) {
        $this->password = $password;
    }
}