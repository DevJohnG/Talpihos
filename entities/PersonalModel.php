<?php
require_once '../config/Database.php';

class Personal {

    // Conexión a la base de datos
    private $db;

    public function __construct() {
        $this->db = new Database(); 
    }

    // Método para obtener todos los empleados
    public function getTodosLosEmpleados() {
        $sql = "SELECT * FROM personal"; 
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para eliminar un empleado por ID
    public function eliminarEmpleado($idPersonal) {
        $sql = "DELETE FROM personal WHERE id_personal = :id_personal";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bindParam(':id_personal', $idPersonal, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
    ?>
