<?php

$conexion = new mysqli('localhost', 'root', '', 'Hospital');

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$query_roles = "SELECT id_rol, nombre_rol FROM Roles";
$result_roles = $conexion->query($query_roles);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #f4f7f9;
            --text-color: #333;
            --border-color: #ccc;
            --error-color: #e74c3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            line-height: 1.6;
            background-color: var(--secondary-color);
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .contenedorForm {
            width: 100%;
            max-width: 400px;
        }

        .formulario {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: var(--primary-color);
            font-weight: 700;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: 600;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 16px;
            font-family: 'Montserrat', sans-serif;
        }

        input:focus, select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }

        button {
            background-color: var(--primary-color);
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }

        button:hover {
            background-color: #2980b9;
        }

        @media (max-width: 480px) {
            .formulario {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <section class="contenedorForm">
    <div class="formulario">
    <h2>Crear Usuario</h2>
    <form action="../controllers/registrar_usuario.php" method="POST">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <label for="cedula">ID Personal:</label>
        <input type="text" id="cedula" name="cedula" required>

        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required>
            <option value="">Selecciona un rol</option>
            <?php
            if ($result_roles->num_rows > 0) {
               
                while($row = $result_roles->fetch_assoc()) {
                    echo '<option value="' . $row['id_rol'] . '">' . $row['nombre_rol'] . '</option>';
                }
            } else {
                echo '<option value="">No hay roles disponibles</option>';
            }
            ?>
        </select>

        <button type="submit">Crear Usuario</button>
    </form>
    </div>
    </section>

</body>

</html>

<?php
// Cierra la conexión
$conexion->close();
?>