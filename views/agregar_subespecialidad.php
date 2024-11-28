<?php
require_once '../controllers/registro_subespecialidad.php';

$controller = new SubEspecialidadController();
$subespecialidad = $controller->obtenerSubEspecialidades();


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
    <title>Gestion Sub Especialidad</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../viewsstyle.css">
       
</head>
<body>

<header>

    <button class="btnHeader" onclick="location.href='admin_dashboard.php'">← Regresar</button>
    <h1>Gestión de SubEspecialidades</h1>

</header>

<br>

<button class="action-btnew" onclick="mostrarFormulario()">Nueva Sub Especialidad</button>
<br><br>
<div class="table-container">
    <table id="tablaSubEspecialidades" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Área Médica</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($subespecialidad as $subespecialidad): ?>
                <tr>
                    <td><?= htmlspecialchars($subespecialidad['id_subEspecialidad']) ?></td>
                    <td><?= htmlspecialchars($subespecialidad['nombre_subEspecialidad']) ?></td>
                    <td><?= htmlspecialchars($subespecialidad['descripcion_subEspecialidad']) ?></td>
                    <td><?= htmlspecialchars($subespecialidad['id_area_medica']) ?></td>
                    <td>
                        <div class="bntsCont">
                            <button class="action-btn" onclick="editarSubEspecialidad(<?= $subespecialidad['id_subEspecialidad'] ?>, '<?= $subespecialidad['nombre_subEspecialidad'] ?>', '<?= $subespecialidad['descripcion_subEspecialidad'] ?>', <?= $subespecialidad['id_area_medica'] ?>)">Editar</button>
                            <button class="action-btn" onclick="eliminarSubEspecialidad(<?= $subespecialidad['id_subEspecialidad'] ?>)">Eliminar</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<form id="formAreaMedica" style="display:none;" method="POST">
    <input type="hidden" name="action" id="action">
    <input type="hidden" name="id_subEspecialidad" id="id_subEspecialidad">
    
    <label for="nombre_subEspecialidad">Nombre de la Sub Especialidad:</label>
    <input type="text" name="nombre_subEspecialidad" id="nombre_subEspecialidad" required>

    <label for="descripcion_subEspecialidad">Descripción:</label>
    <textarea name="descripcion_subEspecialidad" id="descripcion_subEspecialidad" required></textarea>

    <label for="id_area_medica">Área Médica:</label>
    <select name="id_area_medica" id="id_area_medica" required>
        <option value="">Seleccione un área médica</option>
        <?php
       
        require_once '../config/Database.php';
        $database = new Database();
        $db = $database->getConnection();
        $query = "SELECT id_area_medica, nombre_area_medica FROM areas_medicas";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($areas as $area) {
            echo "<option value='{$area['id_area_medica']}'>{$area['nombre_area_medica']}</option>";
        }
        ?>
    </select>
<br><br>
    <button style="width:100%;" class="action-btn" type="submit">Guardar</button>
</form>

<script>
    $(document).ready(function() {
        $('#tablaSubEspecialidades').DataTable({
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

    // Función para mostrar el formulario para crear una nueva subespecialidad
    function mostrarFormulario() {
        $('#formAreaMedica').show();
        $('#action').val('crear');
        $('#id_subEspecialidad').val('');
        $('#nombre_subEspecialidad').val('');
        $('#descripcion_subEspecialidad').val('');
        $('#id_area_medica').val('');
    }

    // Función para editar una subespecialidad
    function editarSubEspecialidad(id, nombre, descripcion, id_area_medica) {
        $('#formAreaMedica').show();
        $('#action').val('actualizar');
        $('#id_subEspecialidad').val(id);
        $('#nombre_subEspecialidad').val(nombre);
        $('#descripcion_subEspecialidad').val(descripcion);
        $('#id_area_medica').val(id_area_medica);
    }

    // Función para eliminar una subespecialidad
    function eliminarSubEspecialidad(id) {
        if (confirm('¿Estás seguro de eliminar esta sub especialidad?')) {
            $.post('../controllers/registro_subespecialidad.php', { action: 'eliminar', id_subEspecialidad: id }, function(response) {
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