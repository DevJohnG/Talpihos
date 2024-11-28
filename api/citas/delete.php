<?php
require_once '../../config/Database.php';
require_once '../../entities/Cita.php';

$database = new Database();
$db = $database->getConnection();

$cita = new Cita($db);

// Obtener los datos enviados en la solicitud
$data = json_decode(file_get_contents("php://input"));

// Verificar que se haya proporcionado el ID
if (!empty($data->id_cita)) {
    $cita->id_cita = $data->id_cita;

    if ($cita->eliminarCita()) {
        http_response_code(200);
        echo json_encode(["message" => "Cita eliminada exitosamente."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Error al eliminar la cita."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Se requiere el ID de la cita."]);
}
?>
