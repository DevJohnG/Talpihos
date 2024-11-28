<?php
require_once '../config/Database.php';

class EspecialidadesController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function crearEspecialidad($nombre, $descripcion, $idSubEspecialidad, $idAreaMedica) {
        $query = "INSERT INTO especialidades (nombre_especialidad, descripcion_especialidad, id_subEspecialidad, id_area_medica)
                  VALUES (:nombre, :descripcion, :id_subEspecialidad, :id_area_medica)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':id_subEspecialidad', $idSubEspecialidad);
        $stmt->bindParam(':id_area_medica', $idAreaMedica);

        return $stmt->execute();
    }

    public function obtenerEspecialidades() {
        $query = "SELECT e.id_especialidad, e.nombre_especialidad, e.descripcion_especialidad, 
                         e.id_subEspecialidad, e.id_area_medica
                  FROM especialidades e";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarEspecialidad($id, $nombre, $descripcion, $idSubEspecialidad, $idAreaMedica) {
        $query = "UPDATE especialidades 
                  SET nombre_especialidad = :nombre, descripcion_especialidad = :descripcion, 
                      id_subEspecialidad = :id_subEspecialidad, id_area_medica = :id_area_medica
                  WHERE id_especialidad = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':id_subEspecialidad', $idSubEspecialidad);
        $stmt->bindParam(':id_area_medica', $idAreaMedica);

        return $stmt->execute();
    }

    public function eliminarEspecialidad($id) {
        $query = "DELETE FROM especialidades WHERE id_especialidad = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new EspecialidadesController();
    $action = $_POST['action'];

    switch ($action) {
        case 'crear':
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $idSubEspecialidad = $_POST['id_subEspecialidad'] ?: null;
            $idAreaMedica = $_POST['id_area_medica'] ?: null;

            if ($controller->crearEspecialidad($nombre, $descripcion, $idSubEspecialidad, $idAreaMedica)) {
                echo "Especialidad registrada con éxito.";
            } else {
                echo "Error al registrar la especialidad.";
            }
            break;

        case 'actualizar':
            $id = $_POST['id_especialidad'];
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $idSubEspecialidad = $_POST['id_subEspecialidad'] ?: null;
            $idAreaMedica = $_POST['id_area_medica'] ?: null;

            if ($controller->actualizarEspecialidad($id, $nombre, $descripcion, $idSubEspecialidad, $idAreaMedica)) {
                echo "Especialidad actualizada con éxito.";
            } else {
                echo "Error al actualizar la especialidad.";
            }
            break;

        case 'eliminar':
            $id = $_POST['id_especialidad'];
            if ($controller->eliminarEspecialidad($id)) {
                echo "Especialidad eliminada con éxito.";
            } else {
                echo "Error al eliminar la especialidad.";
            }
            break;

        default:
            echo "Acción no válida.";
            break;
    }
}
?>
