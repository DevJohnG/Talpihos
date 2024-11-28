<?php
require_once '../../config/Database.php';
require_once '../../entities/Cita.php';

$database = new Database();
$db = $database->getConnection();

$cita = new Cita($db);

// Obtener los datos enviados en la solicitud
$data = json_decode(file_get_contents("php://input"));

// Verificar que los datos requeridos estén presentes
if (!empty($data->id_cita) && (!empty($data->descripcion) || !empty($data->estado) || !empty($data->id_paciente) || !empty($data->id_personal)) || !empty($data->id_disponibilidad)) {
    $cita->id_cita = $data->id_cita;
    $cita->descripcion = $data->descripcion ?? null;
    $cita->estado = $data->estado ?? null;
    $cita->id_paciente = $data->id_paciente ?? null;
    $cita->id_personal = $data->id_personal ?? null;
    $cita->id_disponibilidad = $data->id_disponibilidad ?? null;

    if ($cita->actualizarCita()) {
        http_response_code(200);
        echo json_encode(["message" => "Cita actualizada exitosamente."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Error al actualizar la cita."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Datos incompletos."]);
}
?>
