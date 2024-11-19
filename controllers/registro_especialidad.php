<?php
require_once '../config/Database.php';

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre_especialidad = $_POST['nombre_especialidad'];
    $descripcion_especialidad = $_POST['descripcion_especialidad'];
    $id_subEspecialidad = $_POST['id_subEspecialidad'];
    $id_area_medica = $_POST['id_area_medica'];

    $query = "INSERT INTO Especialidades (nombre_especialidad, descripcion_especialidad, id_subEspecialidad, id_area_medica) 
              VALUES (:nombre_especialidad, :descripcion_especialidad, :id_subEspecialidad, :id_area_medica)";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(':nombre_especialidad', $nombre_especialidad);
    $stmt->bindParam(':descripcion_especialidad', $descripcion_especialidad);
    $stmt->bindParam(':id_subEspecialidad', $id_subEspecialidad);
    $stmt->bindParam(':id_area_medica', $id_area_medica);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Especialidad registrada exitosamente.";
    } else {
        echo "Error al registrar la especialidad: " . $stmt->errorInfo()[2];
    }
    exit;
}

// Verificar si se ha enviado id_area_medica mediante GET
if (isset($_GET['id_area_medica'])) {
    $id_area_medica = $_GET['id_area_medica'];

    $query = "SELECT * FROM sub_especialidades WHERE id_area_medica = :id_area_medica";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_area_medica', $id_area_medica);
    $stmt->execute();

    $subespecialidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($subespecialidades) {
        echo json_encode($subespecialidades);
    } else {
        echo json_encode([]);
    }
    exit; // Salir para evitar cualquier salida adicional
}
echo "No se ha enviado un id_area_medica válido.";
?>
