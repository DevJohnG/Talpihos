<?php
require_once '../config/Database.php'; // Ajusta la ruta al archivo Database.php

// Verifica si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene los datos del formulario
    $nombre_area_medica = $_POST['nombre_area_medica'];
    $descripcion_areaMedica = $_POST['descripcion_areaMedica'];

    // Crea una instancia de la base de datos
    $database = new Database();
    $db = $database->getConnection();

    // Prepara la consulta de inserción
    $query = "INSERT INTO Areas_Medicas (nombre_area_medica, descripcion_areaMedica) VALUES (:nombre_area_medica, :descripcion_areaMedica)";
    
    $stmt = $db->prepare($query);

    // Vincula los parámetros
    $stmt->bindParam(':nombre_area_medica', $nombre_area_medica);
    $stmt->bindParam(':descripcion_areaMedica', $descripcion_areaMedica);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "Área médica registrada exitosamente.";
    } else {
        echo "Error al registrar el área médica.";
    }
}
?>
