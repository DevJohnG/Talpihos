<?php
require_once '../entities/PacientesModel.php';

class PacientesController {
    private $pacientesModel;

    public function __construct() {
        $this->pacientesModel = new PacientesModel();
    }

    // Obtener todos los pacientes
    public function obtenerPacientes() {
        return $this->pacientesModel->getAllPacientes();
    }

    // Crear o actualizar un paciente
    public function guardarPaciente($idPaciente, $cedula, $idTipoSangre) {
        if ($idPaciente) {
            return $this->pacientesModel->updatePaciente($idPaciente, $cedula, $idTipoSangre);
        } else {
            return $this->pacientesModel->createPaciente($cedula, $idTipoSangre);
        }
    }

    // Eliminar un paciente
    public function eliminarPaciente($idPaciente) {
        return $this->pacientesModel->deletePaciente($idPaciente);
    }
}

// Procesamiento de solicitudes AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new PacientesController();
    $action = $_POST['action'];

    switch ($action) {
        case 'obtener':
            echo json_encode($controller->obtenerPacientes());
            break;

        case 'guardar':
            $idPaciente = $_POST['id_paciente'] ?? null;
            $cedula = $_POST['cedula'];
            $idTipoSangre = $_POST['id_tipo_sangre'];
            echo $controller->guardarPaciente($idPaciente, $cedula, $idTipoSangre);
            break;

        case 'eliminar':
            $idPaciente = $_POST['id_paciente'];
            echo $controller->eliminarPaciente($idPaciente);
            break;
    }
}
?>
