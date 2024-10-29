<?php
require_once '../config/Database.php'; // Asegúrate de ajustar la ruta

// Conectar a la base de datos
$db = new Database();
$conn = $db->getConnection();

// Verificar si se han enviado datos mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $nombre_especialidad = $_POST['nombre_especialidad'];
    $descripcion_especialidad = $_POST['descripcion_especialidad'];
    $id_subEspecialidad = $_POST['id_subEspecialidad']; // Asegúrate de que esto esté en el formulario si es necesario
    $id_area_medica = $_POST['id_area_medica']; // Asegúrate de que esto esté en el formulario si es necesario

    // Preparar la consulta SQL
    $query = "INSERT INTO Especialidades (nombre_especialidad, descripcion_especialidad, id_subEspecialidad, id_area_medica) 
              VALUES (:nombre_especialidad, :descripcion_especialidad, :id_subEspecialidad, :id_area_medica)";

    // Preparar la sentencia
    $stmt = $conn->prepare($query);

    // Asignar valores a los parámetros
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
    exit; // Asegúrate de salir para no ejecutar el siguiente bloque de código
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
