<?php
require_once '../config/Database.php';

// Conectar a la base de datos
$database = new Database();
$conn = $database->getConnection();

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_subEspecialidad = $_POST['nombre_subEspecialidad'];
    $descripcion_subEspecialidad = $_POST['descripcion_subEspecialidad'];
    $id_area_medica = $_POST['id_area_medica'];

    // Preparar la consulta SQL
    $query = "INSERT INTO sub_especialidades (nombre_subEspecialidad, descripcion_subEspecialidad, id_area_medica) 
              VALUES (:nombre_subEspecialidad, :descripcion_subEspecialidad, :id_area_medica)";

    // Preparar la sentencia
    $stmt = $conn->prepare($query);

    // Asignar valores a los parámetros
    $stmt->bindParam(':nombre_subEspecialidad', $nombre_subEspecialidad);
    $stmt->bindParam(':descripcion_subEspecialidad', $descripcion_subEspecialidad);
    $stmt->bindParam(':id_area_medica', $id_area_medica);

    // Ejecutar la consulta y comprobar si se realizó correctamente
    if ($stmt->execute()) {
        echo "Subespecialidad registrada exitosamente.";
    } else {
        echo "Error al registrar la subespecialidad: " . $stmt->errorInfo()[2];
    }
} else {
    echo "No se han enviado datos.";
}
?>
