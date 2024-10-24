<?php

require_once __DIR__ . '/../controllers/UserController.php';


class App {
    public function __construct() {
        session_start();

        // Obtener la URL de la solicitud
        $url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : null;
        $url = explode('/', $url);

        $controller = new UserController();

        // Si no hay ninguna URL específica, cargar la vista de login por defecto
        if (empty($url[0])) {
            $controller->loginView();
            return;
        }
        
        // Controlar las diferentes rutas según la URL
        switch ($url[0]) {
            case 'login':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->login();
                } else {
                    $controller->loginView();
                }
                break;
            case 'register':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->register();
                } else {
                    $controller->registerView();
                }
                break;
            case 'admin':
                if (isset($_SESSION['user_id'])) {
                    require_once '../views/admin.php';
                } else {
                    header('Location: ./login');
                }
                break;
            case 'logout':
                $controller->logout();
                break;
            default:
                echo "Página no encontrada";
                break;
        }
    }
}
