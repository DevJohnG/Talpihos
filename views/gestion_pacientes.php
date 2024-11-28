<?php
require_once '../controllers/gestionPacientesControllers.php';

session_start();

// Validar sesión y permisos
if (!isset($_SESSION['usuario_id']) || ($_SESSION['rol'] !== 'SuperUsuario' && $_SESSION['rol'] !== 'Recepcionista')) {
    header("Location: /views/login.php");
    exit();
}

// Controlador para gestionar pacientes
$controller = new PacientesController();
$pacientes = $controller->obtenerPacientes();
?>
<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Pacientes</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../viewsstyle.css">
</head>
<body>

<header>
    <button onclick="location.href='admin_dashboard.php'">← Regresar</button>
    <h1>Gestionar Pacientes</h1>
    <br>
</header>

<br>


<div class="table-container">
    <table id="tablaPacientes" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cédula</th>
                <th>Tipo de Sangre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pacientes as $paciente): ?>
                <tr>
                    <td><?= htmlspecialchars($paciente['id_paciente']) ?></td>
                    <td><?= htmlspecialchars($paciente['cedula']) ?></td>
                    <td><?= htmlspecialchars($paciente['tipo_sangre']) ?></td>
                    <td>
                    <!-- Solo el botón de eliminar -->
                    <button class="action-btn" onclick="eliminarPaciente(<?= htmlspecialchars($paciente['id_paciente'], ENT_QUOTES, 'UTF-8') ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#tablaPacientes').DataTable({
            language: {
                lengthMenu: "Mostrar _MENU_ registros por página",
                zeroRecords: "No se encontraron resultados",
                info: "Mostrando página _PAGE_ de _PAGES_",
                infoEmpty: "No hay registros disponibles",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                search: "Buscar:",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            }
        });
    });

    function filtrarTabla() {
        const input = document.getElementById("searchCedula");
        const filter = input.value.toUpperCase();
        const table = document.getElementById("tablaPacientes");
        const tr = table.getElementsByTagName("tr");

        for (let i = 0; i < tr.length; i++) {
            const td = tr[i].getElementsByTagName("td")[1]; // Buscar en la columna de cédula
            if (td) {
                const txtValue = td.textContent || td.innerText;
                tr[i].style.display = txtValue.toUpperCase().includes(filter) ? "" : "none";
            }
        }
    }

    function eliminarPaciente(idPaciente) {
        if (confirm('¿Estás seguro de eliminar este paciente?')) {
            $.ajax({
                url: '../controllers/gestionPacientesControllers.php',
                type: 'POST',
                data: {
                    action: 'eliminar',
                    id_paciente: idPaciente
                },
                success: function(response) {
                    alert(response); 
                    location.reload();
                },
                error: function() {
                    alert("Error al eliminar el paciente.");
                }
            });
        }
    }
</script>

<br>

<?php require 'templates/footer.php'; ?>
</body>
</html>

