<?php
require_once '../config/Database.php'; 

// Conectar a la base de datos
$db = new Database();
$conn = $db->getConnection();


if (isset($_GET['id_area_medica'])) {
    $id_area_medica = $_GET['id_area_medica'];

    $query = "SELECT * FROM sub_especialidades WHERE id_area_medica = :id_area_medica";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_area_medica', $id_area_medica);
    $stmt->execute();

    $subespecialidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($subespecialidades);
} else {
    echo json_encode([]);
}
?>