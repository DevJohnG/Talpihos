<?php
require_once '../config/Database.php'; // Ajusta la ruta según tu estructura de carpetas

// Estableciendo conexión a la base de datos
$database = new Database();
$db = $database->getConnection();


$especialidades_query = $db->query("SELECT id_especialidad, nombre_especialidad FROM especialidades");
$especialidades = $especialidades_query->fetchAll(PDO::FETCH_ASSOC);

// Consultar los cargos
$cargos_query = $db->query("SELECT id_cargo, nombre_cargo FROM Cargos");
$cargos = $cargos_query->fetchAll(PDO::FETCH_ASSOC);

// Consultar las jornadas laborales
$jornadas_query = $db->query("SELECT id_jornada_laboral, nombre_jornada FROM Jornadas_Laborales");
$jornadas = $jornadas_query->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Personal</title>
    <style>
        :root {
            --primary-color: #4a90e2;
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
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: var(--secondary-color);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }
        input[type="submit"] {
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #3a7bc8;
        }
        @media (max-width: 480px) {
            form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<form action="../controllers/Registro_personal.php" method="POST">
<label for="cedula">Cédula:</label>
    <input type="text" name="cedula" required>

    <label for="id_especialidad">Especialidad:</label>
    <select name="id_especialidad" required>
        <option value="">Seleccione una especialidad</option>
        <?php foreach ($especialidades as $especialidad): ?>
            <option value="<?= $especialidad['id_especialidad']; ?>"><?= $especialidad['nombre_especialidad']; ?></option>
        <?php endforeach; ?>
    </select>


    <label for="id_cargo">Cargo:</label>
    <select name="id_cargo" required>
        <option value="">Seleccione un cargo</option>
        <?php foreach ($cargos as $cargo): ?>
            <option value="<?= $cargo['id_cargo']; ?>"><?= $cargo['nombre_cargo']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="id_jornada_laboral">Jornada Laboral:</label>
    <select name="id_jornada_laboral" required>
        <option value="">Seleccione una jornada laboral</option>
        <?php foreach ($jornadas as $jornada): ?>
            <option value="<?= $jornada['id_jornada_laboral']; ?>"><?= $jornada['nombre_jornada']; ?></option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Registrar Personal">
</form>

</body>
</html>