<?php

require_once 'entities/usuario.php';
require_once 'entities/paciente.php';
require_once 'config/Database.php';

class LoginController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->autenticar($username, $password);

            $database = new Database();
            $db = $database->getConnection();

            if ($usuario) {
                session_start();
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['rol'] = $usuario['nombre_rol'];
                
                echo "Rol del usuario: " . $_SESSION['rol']; 
                
               
                switch ($_SESSION['rol']) {
                    case 'SuperUsuario':
                        header("Location: /views/admin_dashboard.php");
                        break;
                        case 'Paciente':
                            $pacienteModel = new paciente($db);
                            $_SESSION['id_paciente'] = $pacienteModel->getPacienteIdByUserId($_SESSION['usuario_id']);
                            header("Location: /views/perfil.php");
                            break;
                    case 'Doctor':
                        header("Location: /views/doctor_dashboard.php");
                        break;
                    case 'Recepcionista':
                        header("Location: /views/recepcionista_dashboard.php");
                        break;
                    default:
                        echo "No tienes permisos para acceder a esta área.";
                        break;
                }
                exit(); // Terminar el script después de redirigir
            } else {
                echo "Credenciales inválidas."; // Mensaje si las credenciales son incorrectas
            }
        }
    }

    public function logout() {
        // Iniciar la sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Destruir todas las variables de sesión
        session_unset();

        // Destruir la sesión
        session_destroy();

        // Redirigir al usuario a la página de inicio de sesión
        header("Location: /views/login.php");
        exit();
    }
    
    public function handleRequest() {
        if (isset($_GET['action']) && $_GET['action'] == 'logout') {
            $this->logout(); // Llamar al método logout cuando se recibe la acción 'logout'
        }
    }
}






/*
 con esta clase se comparan las contraseñas hasheadas 
require_once 'entities/usuario.php';

class LoginController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $usuarioModel = new Usuario();
            $usuario = $usuarioModel->autenticar($username, $password);

            if ($usuario) {
                session_start();
                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['rol'] = $usuario['nombre_rol'];

                if ($usuario['nombre_rol'] === 'SuperUsuario') {
                    header("Location: /views/admin_dashboard.php");
                } elseif ($usuario['nombre_rol'] === 'Paciente') {
                    header("Location: /views/perfil.php");
                } else {
                    echo "No tienes permisos para acceder a esta área.";
                }
            } else {
                echo "Credenciales inválidas.";
            }
        }
    }
}
    */
    



