<?php

require_once '../config/Database.php';
require_once '../entities/Rol.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_rol = $_POST['nombre_rol'];
    $descripcion = $_POST['descripcion'];

    $database = new Database();
    $db = $database->getConnection();

    try {

        $query = "INSERT INTO roles (nombre_rol, descripcion) VALUES (:nombre_rol, :descripcion)";
        $stmt = $db->prepare($query);

        $stmt->bindParam(':nombre_rol', $nombre_rol);
        $stmt->bindParam(':descripcion', $descripcion);

        if ($stmt->execute()) {
            echo '
        <div id="message" class="success">
            Rol registrado con éxito!.
        </div>
        <script>
            setTimeout(() => {
                window.location.href = "../views/nuevo_rol.php";
            }, 2000);
        </script>
        <style>
            body {
                background-image: url("../image/blurhospital.jpg");
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }
            #message {
                border: 0.5px solid white;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #02D12B; /* Verde chillón */
                color: white;
                padding: 30px 60px;
                border-radius: 15px;
                font-size: 24px; /* Tamaño más grande */
                box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2);
                text-align: center;
            }
            #message.success {
                background-color: #02D12B; /* Verde chillón */
            }
            #message.error {
                background-color: #f44336; /* Color de error */
            }
        </style>
        ';
        exit();
    } else {
        echo '
        <div id="message" class="error">
            Error al registrar el Rol.
        </div>
        <script>
            setTimeout(() => {
                window.location.href = "../views/nuevo_rol.php";
            }, 3000);
        </script>
        <style>
            body {
                background-image: url("../image/blurhospital.jpg");
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }
            #message {
                border: 0.5px solid white;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #f44336; /* Rojo */
                color: white;
                padding: 30px 60px;
                border-radius: 15px;
                font-size: 24px; /* Tamaño más grande */
                box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2);
                text-align: center;
            }
            #message.success {
                background-color: #02D12B; /* Verde chillón */
            }
            #message.error {
                background-color: #f44336; /* Color de error */
            }
        </style>
        ';
        exit();
    }
    } catch (PDOException $exception) {
        echo "Error: " . $exception->getMessage();
    }
} else {
    echo "Método no permitido.";
}
?>
