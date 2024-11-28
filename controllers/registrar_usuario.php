<?php

require_once '../config/Database.php';
require_once '../entities/usuarios.php';

$database = new Database();
$db = $database->getConnection(); 

if (!isset($_POST['username'], $_POST['password'], $_POST['cedula'], $_POST['rol'], $_POST['email'])) {
    echo "Faltan datos en el formulario.";
    exit();
}

$username = $_POST['username'];
$password = $_POST['password'];
$cedula = $_POST['cedula'];
$email = $_POST['email'];
$rol_id = $_POST['rol'];

$query = $db->prepare("SELECT * FROM Usuarios WHERE username = ?");
$query->execute([$username]);

if ($query->rowCount() > 0) {
    echo "El nombre de usuario ya existe. Intenta con otro.";
    exit();
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);


$query = $db->prepare("INSERT INTO Usuarios (username, password, cedula, email) VALUES (?, ?, ?, ?)");
$query->execute([$username, $hashedPassword, $cedula, $email]); 

$id_usuario = $db->lastInsertId();

$query = $db->prepare("INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (?, ?)");
$query->execute([$id_usuario, $rol_id]);

echo '
        <div id="message" class="success">
            Usuario registrado con éxito!.
        </div>
        <script>
            setTimeout(() => {
                window.location.href = "../views/nuevo_usuario.php";
            }, 2000);
        </script>
        <style>
            body {
                background-image: url("../image/blurhospital.jpg");
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
            }
            #message {
                border: 0.5px solid white;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: #02D12B; /* Verde chillón */
                color: white;
                padding: 30px 60px;
                border-radius: 15px;
                font-size: 24px; /* Tamaño más grande */
                box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2);
                text-align: center;
            }
            #message.success {
                background-color: ##02D12B; /* Verde chillón */
            }
            #message.error {
                background-color: #f44336; /* Color de error */
            }
        </style>
        ';
?>



