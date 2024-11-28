<?php
require_once '../../config/Database.php';
require_once '../../entities/Disponibilidad.php';

$database = new Database();
$db = $database->getConnection();

$disponibilidad = new Disponibilidad($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id_disponibilidad) && !empty($data->estado)) {
    $disponibilidad->id_disponibilidad = $data->id_disponibilidad;
    $disponibilidad->estado = $data->estado;

    // Verifica si la disponibilidad está asociada a una cita
    if ($disponibilidad->estado === 'ocupado') {
        if ($disponibilidad->verificarDisponibilidadAsignada()) {
            http_response_code(400);
            echo json_encode(["message" => "La disponibilidad ya está asignada a una cita."]);
            exit;
        }
    }

    if ($disponibilidad->actualizarEstado()) {
        http_response_code(200);
        echo json_encode(["message" => "Estado de disponibilidad actualizado exitosamente."]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Error al actualizar el estado de disponibilidad."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Datos incompletos. Se requiere id_disponibilidad y estado."]);
}
