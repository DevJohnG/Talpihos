<?php

session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'SuperUsuario' && $_SESSION['rol'] !== 'Recepcionista') {
    header("Location: /views/login.php"); 
    exit();
}
require_once '../config/Database.php'; 

$database = new Database();
$db = $database->getConnection();


$especialidades_query = $db->query("SELECT id_especialidad, nombre_especialidad FROM especialidades");
$especialidades = $especialidades_query->fetchAll(PDO::FETCH_ASSOC);

$cargos_query = $db->query("SELECT id_cargo, nombre_cargo FROM Cargos");
$cargos = $cargos_query->fetchAll(PDO::FETCH_ASSOC);

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

        .btnHeader {
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

        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            display: grid;
            gap: 15px;
        }

        h1 {
            font-family: 'Arial', sans-serif;
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2), 0 0 25px rgba(0, 0, 0, 0.1);
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
         width: 170px;
         height: 60px;
}

        .action-btn:hover {
         background-color: #D3D3D3;
        }

        .bntsCont{
        display: flex;
        justify-content: center;
        gap: 10px;
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

        .submit {
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
            font-weight: bold;
        }

        button:hover {
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

<header>
    <button class="btnHeader" onclick="location.href='admin_dashboard.php'">← Regresar</button>
    <h1>Registro de Personal</h1>

</header>

<br>

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

    <input class="submit" type="submit" value="Registrar Personal">
</form>

<br>
    <?php require 'templates/footer.php'; ?>

</body>
</html>