<?php
require_once '../config/Database.php';

if (isset($_POST['cedula'])) {
    try {
        $db = new Database();
        $conn = $db->getConnection();

        $cedula = $_POST['cedula'];

        $query = "DELETE FROM PreRegistro WHERE cedula = :cedula";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();

        echo "Registro eliminado correctamente";
    } catch (PDOException $e) {
        echo "Error al eliminar el registro: " . $e->getMessage();
    }
}
?>
