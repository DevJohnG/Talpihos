<?php

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
    <title>Agregar Especialidad</title>
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
        text-shadow: 3px 3px 8px rgba(0, 0, 0, 0.4);}

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            font-family: 'Arial', sans-serif;
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2), 0 0 25px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
            font-family: 'Montserrat', sans-serif;
        }
        .action-btn {
         padding: 5px 10px;
        background-color: #3498db;
         font-weight: bold;
        color: white;
         border: none;
        border-radius: 4px;
         cursor: pointer;
         font-size: 16px;
         border: 0.5px solid #696969;
         width: 100%;
         height: 60px;
}

.action-btn:hover {
    background-color: #D3D3D3;
}

        select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<header>
    
    <button onclick="location.href='admin_dashboard.php'">← Regresar</button>
    <h1>Registro de Especialidades</h1>

</header>

<br>

    <div class="container">

        <form action="../controllers/registro_especialidad.php" method="POST">
        <div class="form-group">
        <label for="nombre_area_medica">Área Médica:</label>
        <select id="nombre_area_medica" name="id_area_medica" required>
            <option value="">Seleccione un área médica</option>
            <?php
            require_once '../config/Database.php';

           $database = new Database();
           $db = $database->getConnection();

            $query = "SELECT * FROM areas_medicas";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $areas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($areas as $area) {
                echo "<option value='{$area['id_area_medica']}'>{$area['nombre_area_medica']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="nombre_subEspecialidad">Subespecialidad:</label>
        <select id="nombre_subEspecialidad" name="id_subEspecialidad" required>
            <option value="">Seleccione una subespecialidad</option>
            <script> 
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('nombre_area_medica').addEventListener('change', function() {
        var areaId = this.value;
        var subEspecialidadSelect = document.getElementById('nombre_subEspecialidad');

        // Limpia las subespecialidades
        subEspecialidadSelect.innerHTML = "<option value=''>Seleccione una subespecialidad</option>";

        if (areaId) {
            fetch(`../controllers/get_subespecialidades.php?id_area_medica=${areaId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(subEspecialidad => {
                    var option = document.createElement('option');
                    option.value = subEspecialidad.id_subEspecialidad;
                    option.textContent = subEspecialidad.nombre_subEspecialidad;
                    subEspecialidadSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
        }
    });
});
</script>

        </select>
</div>
            <div class="form-group">
                <label for="nombre_Especialidad">Nombre de la Especialidad:</label>
                <input type="text" id="nombre_especialidad" name="nombre_especialidad" required maxlength="100">
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion_especialidad" name="descripcion_especialidad" maxlength="255"></textarea>
            </div>
            <button class="action-btn" type="submit">REGISTRAR</button>
        </form>
    </div>

    <br>
    <?php require 'templates/footer.php'; ?>

</body>
</html>