<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: /views/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 2rem;
            width: 400px;
            margin: 0 auto;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 1rem;
        }
        .input-field {
            margin-bottom: 1.5rem;
            width: 100%;
        }
        .input-field label {
            display: block;
            margin-bottom: 0.5rem;
        }
        .input-field input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .input-field input[type="submit"] {
            background-color: #3498db;
            color: white;
            cursor: pointer;
            border: none;
        }
        .input-field input[type="submit"]:hover {
            background-color: #2980b9;
        }
        .message {
            text-align: center;
            margin-top: 1rem;
        }
        .message.error {
            color: red;
        }
        .message.success {
            color: green;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Cambiar Contraseña</h1>
        
        <?php
        if (isset($_GET['error'])) {
            echo '<div class="message error">' . htmlspecialchars($_GET['error']) . '</div>';
        }
        if (isset($_GET['success'])) {
            echo '<div class="message success">' . htmlspecialchars($_GET['success']) . '</div>';
        }
        ?>

        <form action="../controllers/nueva_contrasena.php" method="POST">
            <div class="input-field">
                <label for="current_password">Contraseña Actual:</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="input-field">
                <label for="new_password">Nueva Contraseña:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="input-field">
                <label for="confirm_password">Confirmar Nueva Contraseña:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="input-field">
                <input type="submit" value="Cambiar Contraseña">
            </div>
        </form>
    </div>

</body>
</html>
