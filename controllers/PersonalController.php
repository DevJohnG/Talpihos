<?php
require_once '../entities/PersonalModel.php'; // Modelo de personal
require_once '../config/Database.php'; // Configuración de la base de datos

class PersonalController {

    // Método para obtener todos los empleados del personal
    public function obtenerPersonal() {
        // Crear una instancia del modelo Personal
        $personalModel = new Personal();

        return $personalModel->getTodosLosEmpleados();
    }

    public function guardarEmpleado($idPersonal, $cedula, $idEspecialidad, $idCargo, $idJornada) {
        $personalModel = new Personal();
        if ($idPersonal) {
            return $personalModel->actualizarEmpleado($idPersonal, $cedula, $idEspecialidad, $idCargo, $idJornada);
        } else {
            return $personalModel->crearEmpleado($cedula, $idEspecialidad, $idCargo, $idJornada);
        }
    }

    // Método para eliminar un empleado
    public function eliminarEmpleado($idPersonal) {
        $personalModel = new Personal();

        // Llamar al método eliminarEmpleado del modelo Personal
        $resultado = $personalModel->eliminarEmpleado($idPersonal);

        if ($resultado) {
            return "Empleado eliminado con éxito.";
        } else {
            return "Error al eliminar el empleado.";
        }
    }

    // Procesamiento de solicitudes AJAX
    public function handleAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'];

            switch ($action) {
                case 'obtener':
                    echo json_encode($this->obtenerPersonal());
                    break;

                case 'guardar':
                    $idPersonal = $_POST['id_personal'] ?? null;
                    $cedula = $_POST['cedula'];
                    $idEspecialidad = $_POST['id_especialidad'];
                    $idCargo = $_POST['id_cargo'];
                    $idJornada = $_POST['id_jornada'];

                    // Guardar o actualizar el empleado
                    echo $this->guardarEmpleado($idPersonal, $cedula, $idEspecialidad, $idCargo, $idJornada);
                    break;

                case 'eliminar':
                    $idPersonal = $_POST['id_personal'];
                    echo $this->eliminarEmpleado($idPersonal);
                    break;

                default:
                    echo "Acción no válida";
            }
        }
    }
}

$controller = new PersonalController();
$controller->handleAction();
?>


