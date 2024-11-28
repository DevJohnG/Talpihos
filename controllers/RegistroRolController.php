<?php
require_once '../config/Database.php';

class RegistroRolController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function crearRol($nombre_rol, $descripcion) {
        $query = "INSERT INTO roles (nombre_rol, descripcion) VALUES (:nombre_rol, :descripcion)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre_rol', $nombre_rol);
        $stmt->bindParam(':descripcion', $descripcion);

        return $stmt->execute();
    }

    public function obtenerRoles() {
        $query = "SELECT * FROM roles";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarRol($id_rol, $nombre_rol, $descripcion) {
        $query = "UPDATE roles SET nombre_rol = :nombre_rol, descripcion = :descripcion WHERE id_rol = :id_rol";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_rol', $id_rol);
        $stmt->bindParam(':nombre_rol', $nombre_rol);
        $stmt->bindParam(':descripcion', $descripcion);

        return $stmt->execute();
    }

    public function eliminarRol($id_rol) {
        $queryCheck = "SELECT COUNT(*) FROM usuarios_roles WHERE id_rol = :id_rol";
        $stmtCheck = $this->db->prepare($queryCheck);
        $stmtCheck->bindParam(':id_rol', $id_rol);
        $stmtCheck->execute();
        $count = $stmtCheck->fetchColumn();

        if ($count > 0) {
            return "No se puede eliminar este rol porque está asignado a usuarios.";
        }

        $query = "DELETE FROM roles WHERE id_rol = :id_rol";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_rol', $id_rol);
        return $stmt->execute() ? "Rol eliminado con éxito." : "Error al eliminar el rol.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new RegistroRolController();
    $action = $_POST['action'];

    switch ($action) {
        case 'crear':
            $nombre_rol = $_POST['nombre_rol'];
            $descripcion = $_POST['descripcion'];

            if ($controller->crearRol($nombre_rol, $descripcion)) {
                echo "Rol creado con éxito.";
            } else {
                echo "Error al crear el rol.";
            }
            break;

        case 'actualizar':
            $id_rol = $_POST['id_rol'];
            $nombre_rol = $_POST['nombre_rol'];
            $descripcion = $_POST['descripcion'];

            if ($controller->actualizarRol($id_rol, $nombre_rol, $descripcion)) {
                echo "Rol actualizado con éxito.";
            } else {
                echo "Error al actualizar el rol.";
            }
            break;

        case 'eliminar':
            $id_rol = $_POST['id_rol'];

            echo $controller->eliminarRol($id_rol);
            break;

        default:
            echo "Acción no válida.";
            break;
    }
}
?>
