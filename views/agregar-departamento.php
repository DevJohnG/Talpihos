<?php
require_once '../controllers/registro_departamento.php';

$controller = new DepartamentoController();
$departamentos = $controller->obtenerDepartamentos();

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
    <title>Gestión de Departamentos</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>

<style>
    :root {
        --primary-color: #3498db;
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
        font-family: 'Arial', sans-serif;
    line-height: 1.6;
    color: var(--text-color);
    padding: 20px;
    background-image: url('../image/blurhospital.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
    }

    .table-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    header {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    color: white;
    background: linear-gradient(135deg, #3498db, #2980b9);
    padding: 20px 40px;
    position: relative;
    top: 0;
    left: 0;
    border-radius: 10px
}

header button {
    padding: 10px 15px;
    background-color: #fff;
    font-weight: bold;
    color: #2980b9;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 12px;
    transition: background 0.3s ease;
    position: absolute;
    left: 50px;
}
header button:hover {
    background: darkgray;
}

h1{
    font-family: 'Arial', sans-serif;
    font-size: 2.5rem;
    font-weight: bold;
    text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2), 0 0 25px rgba(0, 0, 0, 0.1);
}

header:hover {
color: #fff;
background: linear-gradient(135deg, #2980b9, #3498db);
text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);}

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table th, table td {
        padding: 12px 15px;
        text-align: left;
        border: 1px solid var(--border-color);
    }

    table th {
        background-color: var(--primary-color);
        color: #fff;
        font-weight: bold;
    }

    table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    table tr:hover {
        background-color: rgba(52, 152, 219, 0.1);
    }

    .btn {
        display: inline-block;
        padding: 8px 12px;
        background-color: var(--primary-color);
        color: #fff;
        text-decoration: none;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #2980b9;
    }

    .btn-add {
        margin-bottom: 15px;
    }

    .search-container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .search-container input[type="text"] {
        width: 300px;
        padding: 10px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 16px;
    }

    .search-container button {
        margin-left: 10px;
    }


    .action-btn {
        padding: 5px 10px;
        background-color: #fff;
        font-weight: bold;
        color: var(--primary-color);
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        border: 0.5px solid #696969;
        width: 100px;
        height: 50px;
    }

    .action-btnew {
        padding: 5px 10px;
        background-color: #fff;
        font-weight: bold;
        color: var(--primary-color);
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
        border: 0.5px solid #696969;
        width: 150px;
        height: 50px;
    }

    .bntsCont{
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .action-btn:hover {
        background-color: #D3D3D3;
    }

    .action-btnew:hover {
        background-color: #D3D3D3;
    }

    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 15px; 
    }

    .dataTables_wrapper .dataTables_length {
        margin-bottom: 15px;
    }

    #formDepartamento {
    display: none;
    background-color: #fff; /* Fondo blanco para el formulario */
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    margin-top: 30px; /* Margen superior para separar de la tabla */
    width: 50%;
    margin: 30px auto; /* Centrado en la pantalla */
}

#formDepartamento input[type="text"],
#formDepartamento textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid var(--border-color);
    font-size: 16px;
    box-sizing: border-box;
}

/* Estilos para el botón de guardar */
#formDepartamento button {
    padding: 10px 15px;
    background-color: var(--primary-color);
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

/* Efecto al pasar el mouse por el botón de guardar */
#formDepartamento button:hover {
    background-color: #2980b9;
}

</style>

<body>

<header>

    <button class="btnHeader" onclick="location.href='admin_dashboard.php'">← Regresar</button>
    <h1>Gestión de Departamentos</h1>

</header>

<br>

    <button class="action-btnew" onclick="mostrarFormulario()">Nuevo Departamento</button>
    <br>
    <br>
    <div class="table-container">
    <table id="tablaDepartamentos" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departamentos as $departamento): ?>
                <tr>
                    <td><?= $departamento['id_departamento'] ?></td>
                    <td><?= $departamento['nombre_departamento'] ?></td>
                    <td><?= $departamento['descripcion_departamento'] ?></td>
                    <td>
                        <div class="bntsCont">
                        <button class="action-btn" onclick="editarDepartamento(<?= $departamento['id_departamento'] ?>, '<?= $departamento['nombre_departamento'] ?>', '<?= $departamento['descripcion_departamento'] ?>')">Editar</button>
                        <button class="action-btn" onclick="eliminarDepartamento(<?= $departamento['id_departamento'] ?>)">Eliminar</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <form id="formDepartamento" style="display:none;" method="POST">
    <input type="hidden" name="action" id="action">
    <input type="hidden" name="id_departamento" id="id_departamento">
    <label for="nombre_departamento">Nombre:</label>
    <input type="text" name="nombre_departamento" id="nombre_departamento" required>
    <label for="descripcion_departamento">Descripción:</label>
    <textarea name="descripcion_departamento" id="descripcion_departamento" required></textarea>
    <button style="width:100%;" class="action-btn" type="submit">Guardar</button>
</form>


    <script>
        $(document).ready(function() {
            $('#tablaDepartamentos').DataTable({
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
            $('#formDepartamento').show();
            $('#action').val('crear');
            $('#id_departamento').val('');
            $('#nombre_departamento').val('');
            $('#descripcion_departamento').val('');
        }

        function editarDepartamento(id, nombre, descripcion) {
            $('#formDepartamento').show();
            $('#action').val('actualizar');
            $('#id_departamento').val(id);
            $('#nombre_departamento').val(nombre);
            $('#descripcion_departamento').val(descripcion);
        }

        function eliminarDepartamento(id) {
            if (confirm('¿Estás seguro de eliminar este departamento?')) {
                $.post('../controllers/registro_departamento.php', { action: 'eliminar', id_departamento: id }, function(response) {
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
