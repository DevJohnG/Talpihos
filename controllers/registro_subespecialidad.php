<?php
require_once '../config/Database.php';

class SubEspecialidadController {
private $db;

public function __construct() {
    $database = new Database();
    $this->db = $database->getConnection();
}
public function crearSubEspecialidad($nombre, $descripcion, $id_area_medica) {
    $query = "INSERT INTO sub_especialidades (nombre_subEspecialidad, descripcion_subEspecialidad, id_area_medica) 
              VALUES (:nombre, :descripcion, :id_area_medica)";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':id_area_medica', $id_area_medica);
    return $stmt->execute();
}

public function obtenerSubEspecialidades() {
    $query = "SELECT id_subEspecialidad, nombre_subEspecialidad, descripcion_subEspecialidad, id_area_medica FROM sub_especialidades";
    $stmt = $this->db->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function actualizarSubEspecialidad($id, $nombre, $descripcion, $id_area_medica) {
    $query = "UPDATE sub_especialidades 
              SET nombre_subEspecialidad = :nombre, descripcion_subEspecialidad = :descripcion, id_area_medica = :id_area_medica 
              WHERE id_subEspecialidad = :id";
    $stmt = $this->db->prepare($query);
    
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':id_area_medica', $id_area_medica);

    return $stmt->execute();
}

public function eliminarSubEspecialidad($id) {
    $query = "DELETE FROM sub_especialidades WHERE id_subEspecialidad = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $controller = new SubEspecialidadController();  // Asumiendo que $db es la conexión a la base de datos

    switch ($action) {
        case 'crear':
            $nombre = $_POST['nombre_subEspecialidad'];
            $descripcion = $_POST['descripcion_subEspecialidad'];
            $id_area_medica = $_POST['id_area_medica'];  // Asegúrate de enviar el id_area_medica desde el formulario
            if ($controller->crearSubEspecialidad($nombre, $descripcion, $id_area_medica)) {
                echo "Subespecialidad creada con éxito.";
            } else {
                echo "Error al crear la subespecialidad.";
            }
            break;

        case 'actualizar':
            $id = $_POST['id_subEspecialidad'];
            $nombre = $_POST['nombre_subEspecialidad'];
            $descripcion = $_POST['descripcion_subEspecialidad'];
            $id_area_medica = $_POST['id_area_medica'];
            if ($controller->actualizarSubEspecialidad($id, $nombre, $descripcion, $id_area_medica)) {
                echo "Subespecialidad actualizada con éxito.";
            } else {
                echo "Error al actualizar la subespecialidad.";
            }
            break;

        case 'eliminar':
            $id = $_POST['id_subEspecialidad'];
            if ($controller->eliminarSubEspecialidad($id)) {
                echo "Subespecialidad eliminada con éxito.";
            } else {
                echo "Error al eliminar la subespecialidad.";
            }
            break;
    }
}