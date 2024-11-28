<?php
require_once '../controllers/PersonalController.php';

session_start();

// Validar sesión y permisos
if (!isset($_SESSION['usuario_id']) || ($_SESSION['rol'] !== 'SuperUsuario' && $_SESSION['rol'] !== 'Recepcionista')) {
    header("Location: /views/login.php");
    exit();
}

// Controlador para gestionar personal
$controller = new PersonalController();
$personal = $controller->obtenerPersonal();
$controller->handleAction();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Personal</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../viewsstyle.css">
</head>
<body>

<header>
    <button onclick="location.href='admin_dashboard.php'">← Regresar</button>
    <h1>Gestionar Personal</h1>
    <br>
</header>

<br>

<div class="table-container">
    <table id="tablaPersonal" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cédula</th>
                <th>Especialidad</th>
                <th>Cargo</th>
                <th>Jornada Laboral</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($personal as $empleado): ?>
                <tr>
                    <td><?= htmlspecialchars($empleado['id_personal']) ?></td>
                    <td><?= htmlspecialchars($empleado['cedula']) ?></td>
                    <td><?= htmlspecialchars($empleado['id_especialidad']) ?></td>
                    <td><?= htmlspecialchars($empleado['id_cargo']) ?></td>
                    <td><?= htmlspecialchars($empleado['id_jornada_laboral']) ?></td>
                    <td>
                        <!-- Solo el botón de eliminar -->
                        <button class="action-btn" onclick="eliminarPersonal(<?= htmlspecialchars($empleado['id_personal'], ENT_QUOTES, 'UTF-8') ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
</div>

<script>
    $(document).ready(function() {
        $('#tablaPersonal').DataTable({
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
        const table = document.getElementById("tablaPersonal");
        const tr = table.getElementsByTagName("tr");

        for (let i = 0; i < tr.length; i++) {
            const td = tr[i].getElementsByTagName("td")[1]; // Buscar en la columna de cédula
            if (td) {
                const txtValue = td.textContent || td.innerText;
                tr[i].style.display = txtValue.toUpperCase().includes(filter) ? "" : "none";
            }
        }
    }

    function eliminarPersonal(idPersonal) {
    if (confirm('¿Estás seguro de eliminar este personal?')) {
        $.ajax({
            url: '../controllers/PersonalController.php', // Ruta al controlador
            type: 'POST',
            data: {
                action: 'eliminar', // Enviamos la acción
                id_personal: idPersonal // El ID del personal a eliminar
            },
            success: function(response) {
                alert(response);  // Mostrar mensaje de éxito o error
                location.reload();  // Recargar la página para reflejar los cambios
            },
            error: function(xhr, status, error) {
                alert("Error al eliminar el personal.");
            }
        });
    }
    function editarPersonal(idPersonal) {
    $.ajax({
        url: '../controllers/PersonalController.php',
        type: 'GET',
        data: {
            action: 'obtener', // Acción para obtener los datos del personal
            id_personal: idPersonal
        },
        success: function(response) {
            const datos = JSON.parse(response);
            // Asignar los valores al formulario de edición
            document.getElementById('cedula_edit').value = datos.cedula;
            document.getElementById('especialidad_edit').value = datos.id_especialidad;
            document.getElementById('cargo_edit').value = datos.id_cargo;
            document.getElementById('jornada_edit').value = datos.id_jornada_laboral;
            document.getElementById('id_personal_edit').value = datos.id_personal;

            // Mostrar el formulario de edición
            document.getElementById('formulario-edicion').style.display = 'block';
        },
        error: function(xhr, status, error) {
            alert("Error al obtener los datos del personal.");
        }
    });
}
}
</script>
<br>
<?php require 'templates/footer.php'; ?>
</body>
</html>