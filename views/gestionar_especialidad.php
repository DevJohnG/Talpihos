<?php 
require_once '../controllers/EspecialidadesController.php';

$controller = new EspecialidadesController();
$especialidades = $controller->obtenerEspecialidades();

session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'SuperUsuario') {
    header("Location: /views/login.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Especialidades</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../viewsstyle.css">
</head>

<body>

<header>
    <button onclick="location.href='admin_dashboard.php'">← Regresar</button>
    <h1>Gestionar Especialidades</h1>
</header>

<br>

<div class="table-container">
    <table id="tablaEspecialidades" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>ID Sub-Especialidad</th>
                <th>ID Área Médica</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($especialidades as $especialidad): ?>
                <tr>
                    <td><?= htmlspecialchars($especialidad['id_especialidad']) ?></td>
                    <td><?= htmlspecialchars($especialidad['nombre_especialidad']) ?></td>
                    <td><?= htmlspecialchars($especialidad['descripcion_especialidad']) ?></td>
                    <td><?= htmlspecialchars($especialidad['id_subEspecialidad']) ?></td>
                    <td><?= htmlspecialchars($especialidad['id_area_medica']) ?></td>
                    <td>
                        <button class="action-btn" onclick="editarEspecialidad(
                            <?= $especialidad['id_especialidad'] ?>,
                            '<?= htmlspecialchars($especialidad['nombre_especialidad'], ENT_QUOTES, 'UTF-8') ?>',
                            '<?= htmlspecialchars($especialidad['descripcion_especialidad'], ENT_QUOTES, 'UTF-8') ?>',
                            <?= $especialidad['id_subEspecialidad'] ?: 'null' ?>,
                            <?= $especialidad['id_area_medica'] ?: 'null' ?>
                        )">Editar</button>
                        <button class="action-btn" onclick="eliminarEspecialidad(<?= $especialidad['id_especialidad'] ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<form id="formAreaMedica" style="display:none;" method="POST">
    <input type="hidden" name="action" id="action">
    <input type="hidden" name="id_especialidad" id="id_especialidad">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion" required></textarea>
    <label for="id_subEspecialidad">ID Sub-Especialidad:</label>
    <input type="number" name="id_subEspecialidad" id="id_subEspecialidad">
    <br><br>
    <label for="id_area_medica">ID Área Médica:</label>
    <input type="number" name="id_area_medica" id="id_area_medica">
    <br><br>
    <button style="width:100%" class="action-btn" type="submit">Guardar</button>
</form>

<script>
    $(document).ready(function() {
        $('#tablaEspecialidades').DataTable({
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

    function editarEspecialidad(id, nombre, descripcion, idSubEspecialidad, idAreaMedica) {
        $('#formAreaMedica').show();
        $('#action').val('actualizar');
        $('#id_especialidad').val(id);
        $('#nombre').val(nombre);
        $('#descripcion').val(descripcion);
        $('#id_subEspecialidad').val(idSubEspecialidad || '');
        $('#id_area_medica').val(idAreaMedica || '');
    }

    function eliminarEspecialidad(id) {
        if (confirm('¿Estás seguro de eliminar esta especialidad?')) {
            $.post('../controllers/EspecialidadesController.php', { action: 'eliminar', id_especialidad: id }, function(response) {
                alert(response);
                location.reload();
            });
        }
    }
</script>

<br>
<?php require 'templates/footer.php'; ?>

</body>
</html>
