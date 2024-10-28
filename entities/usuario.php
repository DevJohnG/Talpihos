<?php
require_once 'config/Database.php';

class usuario {
    private $conn;
    private $table_name = "usuarios";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function autenticar($username, $password) {
        $query = "SELECT U.id_usuario, U.password, R.nombre_rol
                  FROM " . $this->table_name . " U
                  JOIN usuarios_roles UR ON U.id_usuario = UR.id_usuario
                  JOIN Roles R ON UR.id_rol = R.id_rol
                  WHERE U.username = :username";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verificar la contraseña directamente (sin hash)
        if ($user && $password === $user['password']) {
            return $user;
        }
        return null;
    }
}



/*
require_once 'config/Database.php';

class usuario {
    private $conn;
    private $table_name = "usuarios";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function autenticar($username, $password) {
        $query = "SELECT U.id_usuario, U.password, R.nombre_rol
                  FROM " . $this->table_name . " U
                  JOIN usuarios_roles UR ON U.id_usuario = UR.id_usuario
                  JOIN Roles R ON UR.id_rol = R.id_rol
                  WHERE U.username = :username";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }
}
    */
?>

