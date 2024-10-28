<?php

require_once 'entities/Usuario.php';

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
            
                // Agregar un mensaje de depuración
                echo "Rol del usuario: " . $_SESSION['rol']; // Muestra el rol recuperado
            
                // Redirigir según el rol
                if ($usuario['nombre_rol'] === 'SuperUsuario') {
                    header("Location: /views/admin_dashboard.php");
                } elseif ($usuario['nombre_rol'] === 'Paciente') {
                    header("Location: /views/perfil.php");
                } else {
                    echo "No tienes permisos para acceder a esta área.";
                }
                exit(); // Terminar el script después de redirigir
            } else {
                echo "Credenciales inválidas."; // Mensaje si las credenciales son incorrectas
            }
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
    



