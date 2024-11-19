<?php
require_once '../config/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre_area_medica = $_POST['nombre_area_medica'];
    $descripcion_areaMedica = $_POST['descripcion_areaMedica'];

    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO Areas_Medicas (nombre_area_medica, descripcion_areaMedica) VALUES (:nombre_area_medica, :descripcion_areaMedica)";
    
    $stmt = $db->prepare($query);

    $stmt->bindParam(':nombre_area_medica', $nombre_area_medica);
    $stmt->bindParam(':descripcion_areaMedica', $descripcion_areaMedica);

    if ($stmt->execute()) {
        echo "Área médica registrada exitosamente.";
    } else {
        echo "Error al registrar el área médica.";
    }
}
?>
