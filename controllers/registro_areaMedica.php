<?php
require_once '../config/Database.php';

class AreaMedicaController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function crearAreaMedica($nombre, $descripcion) {
        $query = "INSERT INTO areas_medicas (nombre_area_medica, descripcion_areaMedica) VALUES (:nombre, :descripcion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        return $stmt->execute();
    }

    public function obtenerAreasMedicas() {
        $query = "SELECT id_area_medica, nombre_area_medica, descripcion_areaMedica FROM areas_medicas";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarAreaMedica($id, $nombre, $descripcion) {
        $query = "UPDATE areas_medicas SET nombre_area_medica = :nombre, descripcion_areaMedica = :descripcion WHERE id_area_medica = :id";
        $stmt = $this->db->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        
        return $stmt->execute();
    }

    public function eliminarAreaMedica($id) {
        $query = "DELETE FROM areas_medicas WHERE id_area_medica = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $controller = new AreaMedicaController();

    switch ($action) {
        case 'crear':
            $nombre = $_POST['nombre_area'];
            $descripcion = $_POST['descripcion_area'];
            if ($controller->crearAreaMedica($nombre, $descripcion)) {
                echo "Área médica creada con éxito.";
            } else {
                echo "Error al crear el área médica.";
            }
            break;

        case 'actualizar':
            $id = $_POST['id_area_medica'];
            $nombre = $_POST['nombre_area'];
            $descripcion = $_POST['descripcion_area'];
            if ($controller->actualizarAreaMedica($id, $nombre, $descripcion)) {
                echo "Área médica actualizada con éxito.";
            } else {
                echo "Error al actualizar el área médica.";
            }
            break;

        case 'eliminar':
            $id = $_POST['id_area_medica'];
            if ($controller->eliminarAreaMedica($id)) {
                echo "Área médica eliminada con éxito.";
            } else {
                echo "Error al eliminar el área médica.";
            }
            break;
    }
}
?>

