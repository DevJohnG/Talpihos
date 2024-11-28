<?php

require_once '../config/Database.php';

class DepartamentoController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // agregar
    public function crearDepartamento($nombre, $descripcion) {
        $query = "INSERT INTO Departamentos (nombre_departamento, descripcion_departamento) VALUES (:nombre, :descripcion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);

        return $stmt->execute();
    }

    // busqueda
    public function obtenerDepartamentos() {
        $query = "SELECT id_departamento, nombre_departamento, descripcion_departamento FROM Departamentos";
        $stmt = $this->db->query($query);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // update
    public function actualizarDepartamento($id, $nombre, $descripcion) {
        $query = "UPDATE Departamentos SET nombre_departamento = :nombre, descripcion_departamento = :descripcion WHERE id_departamento = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);

        return $stmt->execute();
    }

    // eliminar
    public function eliminarDepartamento($id) {
        $query = "DELETE FROM Departamentos WHERE id_departamento = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}

//solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $controller = new DepartamentoController();

    switch ($action) {
        case 'crear':
            $nombre = $_POST['nombre_departamento'];
            $descripcion = $_POST['descripcion_departamento'];
            if ($controller->crearDepartamento($nombre, $descripcion)) {
                echo "Departamento creado con éxito.";
            } else {
                echo "Error al crear el departamento.";
            }
            break;

        case 'actualizar':
            $id = $_POST['id_departamento'];
            $nombre = $_POST['nombre_departamento'];
            $descripcion = $_POST['descripcion_departamento'];
            if ($controller->actualizarDepartamento($id, $nombre, $descripcion)) {
                echo "Departamento actualizado con éxito.";
            } else {
                echo "Error al actualizar el departamento.";
            }
            break;

        case 'eliminar':
            $id = $_POST['id_departamento'];
            if ($controller->eliminarDepartamento($id)) {
                echo "Departamento eliminado con éxito.";
            } else {
                echo "Error al eliminar el departamento.";
            }
            break;
    }
}
?>
