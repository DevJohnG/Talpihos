<?php
// Incluye la conexión a la base de datos
require_once '../config/Database.php';

class HistorialClinico {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insertarHistorial($descripcion, $fecha, $id_paciente) {
        $query = "INSERT INTO HistorialClinico (descripcion, fecha, id_paciente) VALUES (:descripcion, :fecha, :id_paciente)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':id_paciente', $id_paciente);

        if ($stmt->execute()) {
            echo "Historial clínico insertado exitosamente.";
        } else {
            echo "Error al insertar el historial clínico.";
        }
    }
}


$database = new Database();
$db = $database->getConnection();

if (isset($_POST['descripcion'], $_POST['fecha'], $_POST['id_paciente'])) {
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $id_paciente = $_POST['id_paciente'];

    $historialClinico = new HistorialClinico($db);
    $historialClinico->insertarHistorial($descripcion, $fecha, $id_paciente);
} else {
    echo "Faltan datos en el formulario.";
}
?>
