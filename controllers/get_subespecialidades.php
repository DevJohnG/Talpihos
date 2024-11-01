<?php
require_once '../config/Database.php'; // Asegúrate de ajustar la ruta

// Conectar a la base de datos
$db = new Database();
$conn = $db->getConnection();

// Verificar si se ha enviado id_area_medica mediante GET
if (isset($_GET['id_area_medica'])) {
    $id_area_medica = $_GET['id_area_medica'];

    $query = "SELECT * FROM sub_especialidades WHERE id_area_medica = :id_area_medica";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_area_medica', $id_area_medica);
    $stmt->execute();

    $subespecialidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($subespecialidades);
} else {
    echo json_encode([]); // En caso de no encontrar el id_area_medica
}
?>
