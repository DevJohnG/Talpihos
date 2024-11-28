<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 300px;
        }
        h2 {
            color: #1a73e8;
            margin-top: 0;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #5f6368;
        }
        input[type="text"] {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #dadce0;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #1a73e8;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #1557b0;
        }
    </style>
</head>
<body>
    <form action="../controllers/procesar_reset.php" method="POST">
        <h2>Restablecer contraseña</h2>
        <label for="username">Nombre de usuario o cédula:</label>
        <input type="text" name="username" id="username" required>
        <button type="submit">Restablecer contraseña</button>
    </form>
</body>
</html>

