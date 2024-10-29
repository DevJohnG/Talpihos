<?php

require_once '../config/Database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_departamento = $_POST['nombre_departamento'];
    $descripcion_departamento = $_POST['descripcion_departamento'];

    $query = "INSERT INTO Departamentos (nombre_departamento, descripcion_departamento) VALUES (:nombre, :descripcion)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nombre', $nombre_departamento);
    $stmt->bindParam(':descripcion', $descripcion_departamento);

    if ($stmt->execute()) {
        echo "Departamento registrado correctamente.";
    } else {
        echo "Error al registrar el departamento.";
    }
}
?>
