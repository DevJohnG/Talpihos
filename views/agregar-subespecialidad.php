<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Sub Especialidad</title>
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
            background-color: var(--secondary-color);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            margin-bottom: 50px;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary-color);
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

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
            font-family: 'Montserrat', sans-serif;
        }

        select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        footer {
    width: 100%;
    background-color: var(--primary-color);
    color: white;
    padding: 10px 0;
    text-align: center;
}
footer h4 {
    margin: 5px 0;
}

        button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2980b9;
        }
        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }
            
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>AGREGAR SUB ESPECIALIDAD</h1>
        <form action="../controllers/registro_subespecialidad.php" method="POST">
            <div class="form-group">
                <label for="nombre_subEspecialidad">Nombre de la Sub Especialidad</label>
                <input type="text" id="nombre_subEspecialidad" name="nombre_subEspecialidad" required maxlength="100">
            </div>
            <div class="form-group">
                <label for="descripcion_subEspecialidad">Descripción:</label>
                <textarea id="descripcion_subEspecialidad" name="descripcion_subEspecialidad" maxlength="250"></textarea>
            </div>
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
            <button type="submit">Registrar</button>
        </form>
    </div>
    <?php include 'Templates/footer.php'; ?>
</body>
</html>