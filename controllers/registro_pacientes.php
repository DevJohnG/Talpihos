<?php

require_once '../config/Database.php';


$database = new Database();
$conn = $database->getConnection(); // Obtener la conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $cedula = $_POST['cedula'];
    $id_tipo_sangre = $_POST['id_tipo_sangre'];

    try {
        // Preparar la consulta SQL
        $sql = "INSERT INTO Pacientes (cedula, id_tipo_sangre) VALUES (:cedula, :id_tipo_sangre)";
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':id_tipo_sangre', $id_tipo_sangre);

        // Ejecutar la consulta
        if($stmt->execute()) {
            echo "Paciente registrado exitosamente.";
        } else {
            echo "Error al registrar el paciente.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Cerrar la conexión
$conn = null;
?>
