<?php
require_once 'controllers/LoginController.php';

$controller = $_GET['controller'] ?? 'LoginController';
$action = $_GET['action'] ?? 'login';

if (class_exists($controller)) {
    $controllerInstance = new $controller();
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        echo "Acción no encontrada.";
    }
} else {
    echo "Controlador no encontrado.";
}
?>

