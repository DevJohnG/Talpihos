<?php
require_once '../config/Database.php';

class RegistroUsuarioController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function crearUsuario($username, $password, $cedula, $email) {
        $query = "INSERT INTO usuarios (username, password, cedula, email) VALUES (:username, :password, :cedula, :email)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    public function obtenerUsuarios() {
        $query = "SELECT id_usuario, username, cedula, password, email FROM usuarios";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario($id_usuario, $username, $cedula, $password, $email) {
        $query = "UPDATE usuarios SET username = :username, cedula = :cedula, email = :email";
        
        if (!empty($password)) {
            $query .= ", password = :password";
        }
    
        $query .= " WHERE id_usuario = :id_usuario";
    
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':email', $email);
    
        if (!empty($password)) {
            $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
        }
    
        return $stmt->execute();
    }

    public function eliminarUsuario($id_usuario) {
        if (!is_numeric($id_usuario)) {
            throw new InvalidArgumentException("ID de usuario no válido");
        }
    
        try {
            $this->db->beginTransaction();
    
            // Primera eliminación
            $queryRoles = "DELETE FROM usuarios_roles WHERE id_usuario = :id_usuario";
            $stmtRoles = $this->db->prepare($queryRoles);
            $stmtRoles->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmtRoles->execute();
    
            // Segunda eliminación
            $queryUsuario = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
            $stmtUsuario = $this->db->prepare($queryUsuario);
            $stmtUsuario->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmtUsuario->execute();
    
            $this->db->commit();
    
            if ($stmtUsuario->rowCount() > 0) {
                return true;
            } else {
                error_log("No se encontró un usuario con ID: $id_usuario.");
                return false;
            }
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Error al eliminar usuario: " . $e->getMessage());
            return false;
        }
    }
    
    
    
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new RegistroUsuarioController();
    $action = $_POST['action'];

    switch ($action) {
        case 'crear':
            $username = $_POST['username'];
            $password = $_POST['password'];
            $cedula = $_POST['cedula'];
            $email = $_POST['email'];
            echo $controller->crearUsuario($username, $password, $cedula, $email) ? "Usuario creado con éxito." : "Error al crear el usuario.";
            break;

        case 'actualizar':
            $id_usuario = $_POST['id_usuario'];
            $username = $_POST['username'];
            $cedula = $_POST['cedula'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            echo $controller->actualizarUsuario($id_usuario, $username, $cedula, $email) ? "Usuario actualizado con éxito." : "Error al actualizar el usuario.";
            break;

            case 'eliminar':
                $id_usuario = $_POST['id_usuario'] ?? null;
                if (!is_numeric($id_usuario)) { // Validación de ID
                    echo "Error: ID de usuario inválido.";
                    exit();
                }
            
                if ($controller->eliminarUsuario($id_usuario)) {
                    echo "Usuario eliminado con éxito.";
                } else {
                    echo "Error al eliminar el usuario. Puede que el usuario no exista.";
                }
                break;
            
            

        default:
            echo "Acción no válida.";
            break;
    }
}
?>
