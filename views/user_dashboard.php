<?php
session_start();
if (!isset($_SESSION['rol'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['username']; ?></h1>
    <p>Esta es tu pantalla de usuario.</p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
