<?php

class Paciente {
    private $conn;
    private $table_name = "pacientes";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getPacienteIdByUserId($userId) {
        $database = new Database();
        $conn = $database->getConnection();

        $sql = "
            SELECT p.id_paciente 
            FROM pacientes p
            INNER JOIN usuarios u ON u.cedula = p.cedula
            WHERE u.id_usuario = :id_usuario";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $userId);

        if ($stmt->execute()) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result['id_paciente'] : null;
        }
        
        return null;
    }
}
?>
