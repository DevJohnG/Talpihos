<?php
require_once '../config/Database.php';
require_once '../entities/Persona.php';

class RegistroPersonaController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function crearPersona($cedula, $nombre, $apellido, $fechaNacimiento, $genero, $nacionalidad) {
        $query = "INSERT INTO persona (cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad)
                  VALUES (:cedula, :nombre, :apellido, :fecha_nacimiento, :genero, :nacionalidad)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':fecha_nacimiento', $fechaNacimiento);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':nacionalidad', $nacionalidad);

        return $stmt->execute();
    }

    public function obtenerPersonas() {
        $query = "SELECT id_persona, cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad FROM persona";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarPersona($cedula, $nombre, $apellido, $fechaNacimiento, $genero, $nacionalidad) {
        $query = "UPDATE persona 
                  SET nombre = :nombre, apellido = :apellido, fecha_nacimiento = :fecha_nacimiento, 
                      genero = :genero, nacionalidad = :nacionalidad
                  WHERE cedula = :cedula";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':fecha_nacimiento', $fechaNacimiento);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':nacionalidad', $nacionalidad);

        return $stmt->execute();
    }

    public function eliminarPersona($cedula) {

        $queryCheck = "SELECT COUNT(*) FROM usuarios WHERE cedula = :cedula";  // Reemplaza 'otras_tablas' por las tablas correspondientes
        $stmtCheck = $this->db->prepare($queryCheck);
        $stmtCheck->bindParam(':cedula', $cedula);
        $stmtCheck->execute();
        $count = $stmtCheck->fetchColumn();
    
        if ($count > 0) {

            return "No se puede eliminar esta persona porque hay registros que dependen de ella. Elimine primero los registros en otras tablas.";
        }
    
        $query = "DELETE FROM persona WHERE cedula = :cedula";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cedula', $cedula);
        if ($stmt->execute()) {
            return "Persona eliminada con éxito.";
        } else {
            return "Error al eliminar la persona.";
        }
    }
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new RegistroPersonaController();
    $action = $_POST['action'];

    switch ($action) {
        case 'crear':
            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $fechaNacimiento = $_POST['fecha_nacimiento'];
            $genero = $_POST['genero'];
            $nacionalidad = $_POST['nacionalidad'];

            if ($controller->crearPersona($cedula, $nombre, $apellido, $fechaNacimiento, $genero, $nacionalidad)) {
                echo "Persona registrada con éxito.";
            } else {
                echo "Error al registrar la persona.";
            }
            break;

        case 'actualizar':

            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $fechaNacimiento = $_POST['fecha_nacimiento'];
            $genero = $_POST['genero'];
            $nacionalidad = $_POST['nacionalidad'];

            if ($controller->actualizarPersona($cedula, $nombre, $apellido, $fechaNacimiento, $genero, $nacionalidad)) {
                echo "Persona actualizada con éxito.";
            } else {
                echo "Error al actualizar la persona.";
            }
            break;

        case 'eliminar':
            $cedula = $_POST['cedula'];
            if ($controller->eliminarPersona($cedula)) {
                echo "Persona eliminada con éxito.";
            } else {
                echo "Error al eliminar la persona.";
            }
            break;

            default:
            echo "Acción no válida.";
            break;
    }
}
?>
