<?php
require_once '../config/Database.php'; 


$database = new Database();
$db = $database->getConnection();


if (!isset($_POST['cedula'], $_POST['id_especialidad'], $_POST['id_cargo'], $_POST['id_jornada_laboral'])) {
    echo "Faltan datos en el formulario.";
    exit();
}

// Recibiendo datos del formulario
$cedula = $_POST['cedula'];
$id_especialidad = $_POST['id_especialidad'];
$id_cargo = $_POST['id_cargo'];
$id_jornada_laboral = $_POST['id_jornada_laboral'];

$query = $db->prepare("INSERT INTO Personal (cedula, id_especialidad, id_cargo, id_jornada_laboral) VALUES (?, ?, ?, ?)");
$query->execute([$cedula, $id_especialidad, $id_cargo, $id_jornada_laboral]);

// Comprobando si la inserción fue exitosa
if ($query) {
    echo "Registro de personal insertado exitosamente.";
} else {
    echo "Error al insertar el registro de personal.";
}
?>

