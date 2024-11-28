<?php
require_once '../controllers/registro_areaMedica.php';

$controller = new AreaMedicaController();
$areasMedicas = $controller->obtenerAreasMedicas();

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
    <title>Gestión de Áreas Médicas</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../viewsstyle.css">
    
</head>
<body>

<header>
    <button class="btnHeader" onclick="location.href='admin_dashboard.php'">← Regresar</button>
    <h1>Gestión de Áreas Médicas</h1>
</header>

<br>

    <button class="action-btnew" onclick="mostrarFormulario()">Nueva Área Médica</button>
    <br><br>
    <div class="table-container">
        <table id="tablaAreasMedicas" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($areasMedicas as $area): ?>
                    <tr>
                        <td><?= htmlspecialchars($area['id_area_medica']) ?></td>
                        <td><?= htmlspecialchars($area['nombre_area_medica']) ?></td>
                        <td><?= htmlspecialchars($area['descripcion_areaMedica']) ?></td>
                        <td>
                            <div class="bntsCont">
                                <button class="action-btn" onclick="editarAreaMedica(<?= $area['id_area_medica'] ?>, '<?= $area['nombre_area_medica'] ?>', '<?= $area['descripcion_areaMedica'] ?>')">Editar</button>
                                <button class="action-btn" onclick="eliminarAreaMedica(<?= $area['id_area_medica'] ?>)">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <form id="formAreaMedica" style="display:none;" method="POST">
    <input type="hidden" name="action" id="action">
    <input type="hidden" name="id_area_medica" id="id_area_medica">
    <label for="nombre_area">Nombre:</label>
    <input type="text" name="nombre_area" id="nombre_area" required>
    <label for="descripcion_area">Descripción:</label>
    <textarea name="descripcion_area" id="descripcion_area" required></textarea>
    <button class="action-btn" style="width:100%;" type="submit">Guardar</button>
</form>

    <script>
        $(document).ready(function() {
            $('#tablaAreasMedicas').DataTable({
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
            $('#id_area_medica').val('');
            $('#nombre_area').val('');
            $('#descripcion_area').val('');
        }

        function editarAreaMedica(id, nombre, descripcion) {
            $('#formAreaMedica').show();
            $('#action').val('actualizar');
            $('#id_area_medica').val(id);
            $('#nombre_area').val(nombre);
            $('#descripcion_area').val(descripcion);
        }

        function eliminarAreaMedica(id) {
            if (confirm('¿Estás seguro de eliminar esta área médica?')) {
                $.post('../controllers/registro_areaMedica.php', { action: 'eliminar', id_area_medica: id }, function(response) {
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