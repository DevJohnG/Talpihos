<?php
require_once '../config/Database.php'; 

$database = new Database();
$db = $database->getConnection();

$cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';

if ($cedula) {
    $query = $db->prepare("
        SELECT h.id_historial, h.descripcion, h.fecha, p.cedula
        FROM HistorialClinico h
        JOIN Pacientes p ON h.id_paciente = p.id_paciente
        WHERE p.cedula = :cedula
    ");
    $query->bindParam(':cedula', $cedula);
} else {
    $query = $db->prepare("
        SELECT h.id_historial, h.descripcion, h.fecha, p.cedula
        FROM HistorialClinico h
        JOIN Pacientes p ON h.id_paciente = p.id_paciente
    ");
}

$query->execute();
$historiales = $query->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($historiales);
?>
