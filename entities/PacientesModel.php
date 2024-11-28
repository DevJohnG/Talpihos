<?php
require_once '../config/Database.php';

class PacientesModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function getAllPacientes() {
        $stmt = $this->db->query("
            SELECT p.id_paciente, p.cedula, t.tipo_sangre
            FROM pacientes p
            LEFT JOIN tiposdesangre t ON p.id_tipo_sangre = t.id_tipo_sangre
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPaciente($cedula, $idTipoSangre) {
        $stmt = $this->db->prepare("
            INSERT INTO pacientes (cedula, id_tipo_sangre)
            VALUES (:cedula, :id_tipo_sangre)
        ");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':id_tipo_sangre', $idTipoSangre);
        return $stmt->execute();
    }

    public function updatePaciente($idPaciente, $cedula, $idTipoSangre) {
        $stmt = $this->db->prepare("
            UPDATE pacientes
            SET cedula = :cedula, id_tipo_sangre = :id_tipo_sangre
            WHERE id_paciente = :id_paciente
        ");
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':id_tipo_sangre', $idTipoSangre);
        $stmt->bindParam(':id_paciente', $idPaciente);
        return $stmt->execute();
    }

    public function deletePaciente($idPaciente) {
        $stmt = $this->db->prepare("DELETE FROM pacientes WHERE id_paciente = :id_paciente");
        $stmt->bindParam(':id_paciente', $idPaciente);
        return $stmt->execute();
    }
}
?>
