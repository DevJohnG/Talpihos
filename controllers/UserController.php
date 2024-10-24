<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../entities/usuario.php';

class UserController {

    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    // Mostrar vista de login
    public function loginView() {
        require_once 'views/login.php';
    }

    // Procesar inicio de sesión
    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT u.id_usuario, u.password, r.nombre_rol 
                  FROM Usuarios u
                  JOIN usuarios_roles ur ON u.id_usuario = ur.id_usuario
                  JOIN Roles r ON ur.id_rol = r.id_rol
                  WHERE u.username = :username";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id_usuario'];
            $_SESSION['rol'] = $user['nombre_rol'];

            if ($user['nombre_rol'] === 'Administrador' || $user['nombre_rol'] === 'SuperUsuario') {
                header('Location: ./admin');
            } else {
                header('Location: ./dashboard');
            }
            exit();
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    }

    // Mostrar vista de registro
    public function registerView() {
        require_once 'views/register.php';
    }

    // Procesar registro
    public function register() {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $id_personal = $_POST['id_personal'];

        $query = "INSERT INTO Usuarios (username, password, id_personal) VALUES (:username, :password, :id_personal)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id_personal', $id_personal);

        if ($stmt->execute()) {
            echo "Usuario registrado exitosamente";
        } else {
            echo "Error al registrar el usuario";
        }
    }

    // Cerrar sesión
    public function logout() {
        session_destroy();
        header('Location: ./login');
        exit();
    }
}
