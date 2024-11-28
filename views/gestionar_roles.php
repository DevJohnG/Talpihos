<?php 
require_once '../controllers/RegistroRolController.php';

$controller = new RegistroRolController();
$roles = $controller->obtenerRoles();

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
    <title>Gestión de Roles</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../viewsstyle.css">
</head>
<body>
<header>
    <button onclick="location.href='admin_dashboard.php'">← Regresar</button>
    <h1>Gestionar Roles</h1>
</header>

<br>

<div class="table-container">
    <table id="tablaRoles" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Rol</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $rol): ?>
                <tr>
                    <td><?= htmlspecialchars($rol['id_rol']) ?></td>
                    <td><?= htmlspecialchars($rol['nombre_rol']) ?></td>
                    <td><?= htmlspecialchars($rol['descripcion']) ?></td>
                    <td>
                        <button class="action-btn" onclick="editarRol(
                            <?= $rol['id_rol'] ?>, 
                            '<?= htmlspecialchars($rol['nombre_rol'], ENT_QUOTES, 'UTF-8') ?>', 
                            '<?= htmlspecialchars($rol['descripcion'], ENT_QUOTES, 'UTF-8') ?>'
                        )">Editar</button>
                        <button class="action-btn" onclick="eliminarRol(<?= $rol['id_rol'] ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<form id="formAreaMedica" style="display:none;" method="POST">
    <input type="hidden" name="action" id="action">
    <input type="hidden" name="id_rol" id="id_rol">
    <label for="nombre_rol">Nombre del Rol:</label>
    <input type="text" name="nombre_rol" id="nombre_rol" required>
    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion" id="descripcion" required></textarea>
    <button style="width:100%" class="action-btn" type="submit">Guardar</button>
</form>

<script>
    $(document).ready(function() {
        $('#tablaRoles').DataTable({
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

    function editarRol(id, nombre, descripcion) {
        $('#formAreaMedica').show();
        $('#action').val('actualizar');
        $('#id_rol').val(id);
        $('#nombre_rol').val(nombre);
        $('#descripcion').val(descripcion);
    }

    function eliminarRol(id) {
        if (confirm('¿Estás seguro de eliminar este rol?')) {
            $.post('../controllers/RegistroRolController.php', { action: 'eliminar', id_rol: id }, function(response) {
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
