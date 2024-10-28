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
            echo "Rol creado exitosamente.";
        } else {
            echo "Error al crear el rol.";
        }
    } catch (PDOException $exception) {
        echo "Error: " . $exception->getMessage();
    }
} else {
    echo "Método no permitido.";
}
?>
