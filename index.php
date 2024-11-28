<?php

require_once 'controllers/LoginController.php';  


$action = $_GET['action'] ?? 'login'; 

if ($action === 'logout') {
   
    $controller = new LoginController();
    $controller->logout();  
    exit();  
} else {
    
    $controller = 'LoginController';
    
    // Verificar que el controlador existe
    if (class_exists($controller)) {
        // Crear una instancia del controlador
        $controllerInstance = new $controller();
        
        if (method_exists($controllerInstance, $action)) {
            
            $controllerInstance->$action();
        } else {
            echo "Acción no encontrada: '$action'.";
        }
    } else {
        echo "Controlador no encontrado: '$controller'.";
    }
}
?>



