<?php

require_once '../controllers/Registro_persona.php';

$controller = new RegistroPersonaController();
$persona = $controller->obtenerPersonas();

session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'SuperUsuario'&& $_SESSION['rol'] !== 'Recepcionista') {
    header("Location: /views/login.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Personas</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../viewsstyle.css">
       
</head>
    
</head>
<body>

<header>
    
<br>
<br>

    <button onclick="location.href='admin_dashboard.php'">← Regresar</button>
    <h1>Gestionar Personas</h1>
    <br>

</header>

        <div class="table-container">
    <table id="tablaPersonas" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>Género</th>
                <th>Nacionalidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($persona as $persona): ?>
                <tr>
                    <td><?= htmlspecialchars($persona['id_persona']) ?></td>
                    <td><?= htmlspecialchars($persona['cedula']) ?></td>
                    <td><?= htmlspecialchars($persona['nombre']) ?></td>
                    <td><?= htmlspecialchars($persona['apellido']) ?></td>
                    <td><?= htmlspecialchars($persona['fecha_nacimiento']) ?></td>
                    <td><?= htmlspecialchars($persona['genero']) ?></td>
                    <td><?= htmlspecialchars($persona['nacionalidad']) ?></td>
                    <td>
                        <div class="bntsCont">
                        <button class="action-btn" onclick="editarPersona(
    <?= $persona['id_persona'] ?>, 
    '<?= htmlspecialchars($persona['cedula'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($persona['nombre'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($persona['apellido'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($persona['fecha_nacimiento'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($persona['genero'], ENT_QUOTES, 'UTF-8') ?>', 
    '<?= htmlspecialchars($persona['nacionalidad'], ENT_QUOTES, 'UTF-8') ?>'
)">Editar</button>

<button class="action-btn" onclick="eliminarPersona(<?= $persona['cedula'] ?>)">Eliminar</button>
</div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<form id="formAreaMedica" style="display:none;" method="POST">
    <input type="hidden" name="action" id="action">
    <input type="hidden" name="id_persona" id="id_persona">
    <label for="cedula">Cédula:</label>
    <input type="text" name="cedula" id="cedula" required>
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>
    <label for="apellido">Apellido:</label>
    <textarea name="apellido" id="apellido" required></textarea>
    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
    <textarea name="fecha_nacimiento" id="fecha_nacimiento" required></textarea>
    <label for="apellido">Género:</label>
    <select name="genero" id="genero" required>
        <option value="masculino">Masculino</option>
        <option value="femenino">Femenino</option>
        <option value="otro">Otro</option>
    </select>
    <br>
    <br>
    <label for="nacionalidad">Nacionalidad:</label>
    <textarea name="nacionalidad" id="nacionalidad" required></textarea>
    <button style="width:100%;" class="action-btn" type="submit">Guardar</button>
</form>

<script>
        $(document).ready(function() {
            $('#tablaPersonas').DataTable({
                language: {
                    lengthMenu: "Mostrar MENU registros por página",
                    zeroRecords: "No se encontraron resultados",
                    info: "Mostrando página PAGE de PAGES",
                    infoEmpty: "No hay registros disponibles",
                    infoFiltered: "(filtrado de MAX registros totales)",
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
    $('#id_persona').val('');
    $('#cedula').val('');
    $('#nombre').val('');
    $('#apellido').val('');
    $('#fecha_nacimiento').val('');
    $('#genero').val('');
    $('#nacionalidad').val('');
}

function editarPersona(id, cedula, nombre, apellido, fechaNacimiento, genero, nacionalidad) {
    $('#formAreaMedica').show();
    $('#action').val('actualizar');
    $('#id_persona').val(id);
    $('#cedula').val(cedula);
    $('#nombre').val(nombre);
    $('#apellido').val(apellido);
    $('#fecha_nacimiento').val(fechaNacimiento);
    $('#genero').val(genero);
    $('#nacionalidad').val(nacionalidad);
}

function eliminarPersona(cedula) {
    if (confirm('¿Estás seguro de eliminar esta persona?')) {
        $.post('../controllers/registro_persona.php', { action: 'eliminar', cedula: cedula }, function(response) {
            alert(response); 
            location.reload();
        });
    }
}

    </script>
    <br>
    <?php require 'templates/footer.php'; ?>

    </div>
</body>
</html>