<?php
require_once '../../config/Database.php';
require_once '../../entities/Cita.php';

$database = new Database();
$db = $database->getConnection();

$cita = new Cita($db);

$data = json_decode(file_get_contents("php://input"));

// Validación básica y de tipo
if (!empty($data->descripcion) && !empty($data->estado) && !empty($data->id_paciente) && !empty($data->id_personal) && !empty($data->id_disponibilidad)
    && is_string($data->descripcion) && is_numeric($data->id_paciente) && is_numeric($data->id_personal)
    && in_array($data->estado, ['programada', 'completada', 'cancelada'])) {
    
    // Asignación de propiedades
    $cita->descripcion = htmlspecialchars(strip_tags($data->descripcion)); // Sanitización básica
    $cita->estado = $data->estado;
    $cita->id_paciente = $data->id_paciente;
    $cita->id_personal = $data->id_personal;
    $cita->id_disponibilidad = $data->id_disponibilidad;

    try {
        if ($cita->crearCita()) {
            $idCreado = $db->lastInsertId();
            http_response_code(201);
            echo json_encode(["message" => "Cita creada exitosamente.", "id_cita" => $idCreado]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Error al crear la cita."]);
        }
    } catch (PDOException $e) {
        error_log("Error en la base de datos: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(["message" => "Ocurrió un error interno."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Datos incompletos o inválidos."]);
}
?>