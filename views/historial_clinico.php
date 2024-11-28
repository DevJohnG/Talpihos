<?php

session_start();


if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'Doctor') {
    header("Location: /views/login.php"); 
    exit();
}
require_once '../config/Database.php'; // Ajusta la ruta según tu estructura de carpetas

$database = new Database();
$db = $database->getConnection();

// Consulta las cédulas y los ID de pacientes
$pacientes_query = $db->query("SELECT id_paciente, cedula FROM Pacientes");
$pacientes = $pacientes_query->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Historial Clínico</title>
    <style>
        /* CSS for styling */
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #f4f7f9;
            --text-color: #333;
            --border-color: #ccc;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: var(--secondary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        h1 {
            text-align: center;
            color: var(--primary-color);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label, select, input, textarea, button {
            margin-bottom: 15px;
            font-size: 16px;
        }
        button {
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #3a7bc8;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const pacientes = <?php echo json_encode($pacientes); ?>;

            const cedulaInput = document.getElementById("cedula");
            const idPacienteInput = document.getElementById("id_paciente");

            // Actualiza el ID del paciente según la cédula seleccionada
            cedulaInput.addEventListener("input", () => {
                const cedulaSeleccionada = cedulaInput.value;
                const paciente = pacientes.find(p => p.cedula === cedulaSeleccionada);
                idPacienteInput.value = paciente ? paciente.id_paciente : '';
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Registro de Historial Clínico</h1>
        <form action="../controllers/historial_clinico.php" method="POST">
            <label for="cedula">Cédula del Paciente:</label>
            <!-- Campo de búsqueda con lista de sugerencias -->
            <input list="cedulas" id="cedula" name="cedula" placeholder="Buscar cédula..." required>
            <datalist id="cedulas">
                <?php foreach ($pacientes as $paciente): ?>
                    <option value="<?= $paciente['cedula']; ?>"></option>
                <?php endforeach; ?>
            </datalist>

            <input type="hidden" id="id_paciente" name="id_paciente" required>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>

            <button type="submit">Registrar Historial</button>
        </form>
    </div>
</body>
</html>