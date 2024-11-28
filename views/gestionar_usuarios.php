<?php 
require_once '../controllers/GestionUsuariosController.php';

$controller = new RegistroUsuarioController();
$usuarios = $controller->obtenerUsuarios();

session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'SuperUsuario' && $_SESSION['rol'] !== 'Recepcionista') {
    header("Location: /views/login.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../viewsstyle.css">
</head>
<body>

<header>
    <button onclick="location.href='admin_dashboard.php'">← Regresar</button>
    <h1>Gestionar Usuarios</h1>
    <br>
</header>

<br>

<div style="overflow-x: auto;" class="table-container">
    <table style="width: 100%;border-collapse: collapse;font-size:14px;" id="tablaUsuarios" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Cédula</th>
                <th>Contraseña</th>
                <th>Correo Electrónico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['id_usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['username']) ?></td>
                    <td><?= htmlspecialchars($usuario['cedula']) ?></td>
                    <td><?= htmlspecialchars($usuario['password']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td>
                        <div class="bntsCont">
                        <button class="action-btn" onclick="editarUsuario(
    <?= $usuario['id_usuario'] ?>, 
    '<?= htmlspecialchars($usuario['username'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($usuario['cedula'], ENT_QUOTES, 'UTF-8') ?>'
    '<?= htmlspecialchars($usuario['password'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8') ?>'
)">Editar</button>
                            <button class="action-btn" onclick="eliminarUsuario(<?= $usuario['id_usuario'] ?>)">Eliminar</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<form id="formAreaMedica" style="display:none;" method="POST">
    <input type="hidden" name="action" id="action">
    <input type="hidden" name="id_usuario" id="id_usuario">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <label for="cedula">Cédula:</label>
    <input type="text" name="cedula" id="cedula" required>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <label for="email">Correo:</label>
    <input type="email" id="email" name="email" required>
    <button style="width:100%" class="action-btn" type="submit">Guardar</button>
</form>

<script>
    $(document).ready(function() {
        $('#tablaUsuarios').DataTable({
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

    function mostrarFormulario() {
        $('#formAreaMedica').show();
        $('#action').val('crear');
        $('#id_usuario').val('');
        $('#username').val('');
        $('#cedula').val('');
        $('#password').val('');
        $('#email').val('');
    }

    function editarUsuario(id, username, cedula, password, email) {
    $('#formAreaMedica').show();
    $('#action').val('actualizar');
    $('#id_usuario').val(id);
    $('#username').val(username);
    $('#cedula').val(cedula);
    $('#password').val(password);
    $('#email').val(email);
}


function eliminarUsuario(id) {
    if (confirm('¿Estás seguro de eliminar este usuario?')) {
        $.post('../controllers/GestionUsuariosController.php', { action: 'eliminar', id_usuario: id }, function(response) {
            console.log('Respuesta del servidor:', response); // Verifica la respuesta en consola
            alert(response); 
            location.reload(); // Recarga la página
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error('Error en la solicitud:', textStatus, errorThrown); // Mensaje en consola
            alert('Error al eliminar el usuario. Por favor revisa.');
        });
    }
}

</script>
<br>
<?php require 'templates/footer.php'; ?>
</body>
</html>
