<?php
require_once '../../config/Database.php';

$database = new Database();
$db = $database->getConnection();

// Verificar si se proporciona id_personal
if (!isset($_GET['id_personal'])) {
    http_response_code(400);
    echo json_encode(["message" => "El parámetro 'id_personal' es obligatorio."]);
    exit;
}

$id_personal = $_GET['id_personal'];
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : null;

// Consulta base para obtener bloques de disponibilidad
$query = "SELECT id_disponibilidad, fecha, hora_inicio, hora_fin, estado 
          FROM disponibilidad 
          WHERE id_personal = :id_personal";

// Si se proporciona la fecha, se agrega como criterio adicional
if ($fecha) {
    $query .= " AND fecha = :fecha";
}

// Preparar y ejecutar la consulta
$stmt = $db->prepare($query);
$stmt->bindParam(':id_personal', $id_personal, PDO::PARAM_INT);

if ($fecha) {
    $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
}

try {
    $stmt->execute();
    $disponibilidad = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($disponibilidad) {
        // Convertir resultados al formato esperado por FullCalendar
        $events = array_map(function($row) {
            return [
                'id' => $row['id_disponibilidad'],
                'title' => $row['estado'] === 'ocupado' ? 'Ocupado' : 'Disponible',
                'start' => "{$row['fecha']}T{$row['hora_inicio']}",
                'end' => "{$row['fecha']}T{$row['hora_fin']}",
                'color' => $row['estado'] === 'ocupado' ? '#e74c3c' : '#27ae60', // Rojo para ocupado, verde para disponible
            ];
        }, $disponibilidad);

        http_response_code(200);
        echo json_encode($events);
    } else {
        http_response_code(404);
        echo json_encode(["message" => "No se encontraron bloques de disponibilidad."]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["message" => "Error al obtener los bloques de disponibilidad.", "error" => $e->getMessage()]);
}
?>
