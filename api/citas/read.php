<?php
require_once '../../config/Database.php';
require_once '../../entities/Cita.php';

$database = new Database();
$db = $database->getConnection();

$cita = new Cita($db);
    
$stmt = $cita->leerCitas();
$citas = $stmt->fetchAll(PDO::FETCH_ASSOC);

http_response_code(200);
echo json_encode($citas);
?>
