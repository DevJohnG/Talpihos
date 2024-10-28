<?php

require_once '../config/Database.php';
require_once '../entities/usuarios.php';

$database = new Database();
$db = $database->getConnection(); 

if (!isset($_POST['username'], $_POST['password'], $_POST['cedula'], $_POST['rol'])) {
    echo "Faltan datos en el formulario.";
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];
$cedula = $_POST['cedula'];
$rol_id = $_POST['rol'];

$query = $db->prepare("SELECT * FROM Usuarios WHERE username = ?");
$query->execute([$username]);

if ($query->rowCount() > 0) {
    echo "El nombre de usuario ya existe. Intenta con otro.";
    exit();
}

$query = $db->prepare("INSERT INTO Usuarios (username, password, cedula) VALUES (?, ?, ?)");
$query->execute([$username, $password, $cedula]); 

$id_usuario = $db->lastInsertId();

$query = $db->prepare("INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (?, ?)");
$query->execute([$id_usuario, $rol_id]);

echo "Usuario creado exitosamente con el rol asignado.";
?>

