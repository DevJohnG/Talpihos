<?php
require_once '../../config/Database.php';
require_once '../../entities/Disponibilidad.php';

$database = new Database();
$db = $database->getConnection();

$disponibilidad = new Disponibilidad($db);

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->id_personal) && !empty($data->fecha) && !empty($data->hora_inicio) && !empty($data->hora_fin)) {
    $disponibilidad->id_personal = $data->id_personal;
    $disponibilidad->fecha = $data->fecha;
    $disponibilidad->hora_inicio = $data->hora_inicio;
    $disponibilidad->hora_fin = $data->hora_fin;
    $disponibilidad->estado = 'disponible'; // Estado inicial

    if ($disponibilidad->crearDisponibilidad()) {
        http_response_code(201);
        echo json_encode(["message" => "Bloque de disponibilidad creado exitosamente."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Error al crear bloque de disponibilidad."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Datos incompletos."]);
}