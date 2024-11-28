<?php
require '../config/Database.php';

session_start();

// Validación de sesión para verificar el rol de SuperUsuario
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'SuperUsuario') {
    header("Location: /views/login.php"); 
    exit();
}

try {
    // Conexión a la base de datos
    $db = new Database();
    $conn = $db->getConnection();

    // Consulta para obtener todos los registros de la tabla PreRegistro
    $query = "SELECT * FROM PreRegistro";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Obtener los resultados en un arreglo
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error al conectar a la base de datos: " . $e->getMessage();
    exit();  // Aseguramos que la ejecución se detenga en caso de error
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pre-registros</title>
    <style>
        :root {
            --primary-color: #4a90e2;
            --secondary-color: #f4f7f9;
            --text-color: #333;
            --border-color: #e0e0e0;
            --success-color: #28a745;
            --danger-color: #dc3545;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            padding:20px;
            display: flex;
            flex-direction: column;
            background-image: url('../image/blurhospital.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        header {
            display: flex;
            align-items: center;
            justify-content: center; /* Centra los elementos dentro del header */
            width: 100%;
            color: white;
            background: linear-gradient(135deg, #3498db, #2980b9);
            padding: 20px 40px;
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

        header:hover {
        color: #fff;
        background: linear-gradient(135deg, #2980b9, #3498db);
        text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);
    }

        h1 {
            font-family: 'Arial', sans-serif;
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2), 0 0 25px rgba(0, 0, 0, 0.1);
        }
        .table-container {
            overflow-x: auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }
        th {
            background-color: var(--primary-color);
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        tr:hover {
            background-color: #e9ecef;
        }
        .photo-container {
            width: 100px;
            height: 100px;
            overflow: hidden;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .photo-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .photo-container:hover img {
            transform: scale(1.1);
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }
        .btn-approve {
            background-color: var(--success-color);
            color: white;
        }
        .btn-approve:hover {
            background-color: #218838;
        }
        .btn-delete {
            background-color: var(--danger-color);
            color: white;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        @media (max-width: 768px) {
            table {
                font-size: 14px;
            }
            th, td {
                padding: 10px;
            }
            .photo-container {
                width: 80px;
                height: 80px;
            }
        }
    </style>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<header>
    
    <button onclick="location.href='admin_dashboard.php'">← Regresar</button>
    <h1>Lista de Pre-Registros</h1>

</header>

<br>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Fecha de Nacimiento</th>
                <th>Género</th>
                <th>Nacionalidad</th>
                <th>Tipo de Sangre</th>
                <th>Correo</th>
                <th>Foto Cédula (Frente)</th>
                <th>Foto Cédula (Atrás)</th>
                <th>Foto Persona con Cédula</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registros as $registro): ?>
                <tr>
                    <td><?php echo htmlspecialchars($registro['cedula']); ?></td>
                    <td><?php echo htmlspecialchars($registro['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($registro['apellido']); ?></td>
                    <td><?php echo htmlspecialchars($registro['fecha_nacimiento']); ?></td>
                    <td><?php echo htmlspecialchars($registro['genero']); ?></td>
                    <td><?php echo htmlspecialchars($registro['nacionalidad']); ?></td>
                    <td><?php echo htmlspecialchars($registro['tipo_sangre']); ?></td>
                    <td><?php echo htmlspecialchars($registro['correo']); ?></td>
                    <td>
                        <div class="photo-container">
                            <img src="<?php echo htmlspecialchars($registro['foto_cedula_frontal']); ?>" alt="Foto Cédula Frontal">
                        </div>
                    </td>
                    <td>
                        <div class="photo-container">
                            <img src="<?php echo htmlspecialchars($registro['foto_cedula_trasera']); ?>" alt="Foto Cédula Trasera">
                        </div>
                    </td>
                    <td>
                        <div class="photo-container">
                            <img src="<?php echo htmlspecialchars($registro['foto_persona_con_cedula']); ?>" alt="Foto Persona con Cédula">
                        </div>
                    </td>
                    <td>
                    <div class="action-buttons">
                    <button class="btn btn-approve" onclick="aceptarRegistro('<?php echo htmlspecialchars($registro['cedula']); ?>')">Aceptar</button>
                    <button class="btn btn-delete" onclick="eliminarRegistro('<?php echo htmlspecialchars($registro['cedula']); ?>')">Eliminar</button>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
     function aceptarRegistro(cedula) {
        if (confirm("¿Estás seguro de que deseas aceptar este registro?")) {
            $.ajax({
                url: '../controllers/aceptar_preregistro.php',
                type: 'POST',
                data: { cedula: cedula },
                success: function(response) {
                    alert(response);
                    // Eliminar fila de la tabla después de aceptar el registro
                    $('tr[data-cedula="' + cedula + '"]').remove();
                },
                error: function(xhr, status, error) {
                    alert("Hubo un error al aceptar el registro.");
                }
            });
        }
    }
    function eliminarRegistro(cedula) {
        if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
            $.ajax({
                url: '../controllers/eliminar_preregistro.php',
                type: 'POST',
                data: { cedula: cedula },
                success: function(response) {
                    alert(response);
                    location.reload();

                    $('tr[data-cedula="' + cedula + '"]').remove();
                },
                error: function(xhr, status, error) {
                    alert("Hubo un error al eliminar el registro.");
                }
            });
        }
    }
</script>

<br>
    <?php require 'templates/footer.php'; ?>

</body>
</html>
