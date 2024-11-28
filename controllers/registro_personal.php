<?php
require_once '../config/Database.php'; 


$database = new Database();
$db = $database->getConnection();


if (!isset($_POST['cedula'], $_POST['id_especialidad'], $_POST['id_cargo'], $_POST['id_jornada_laboral'])) {
    echo "Faltan datos en el formulario.";
    exit();
}


$cedula = $_POST['cedula'];
$id_especialidad = $_POST['id_especialidad'];
$id_cargo = $_POST['id_cargo'];
$id_jornada_laboral = $_POST['id_jornada_laboral'];

$query = $db->prepare("INSERT INTO Personal (cedula, id_especialidad, id_cargo, id_jornada_laboral) VALUES (?, ?, ?, ?)");
$query->execute([$cedula, $id_especialidad, $id_cargo, $id_jornada_laboral]);


if ($query) {
    echo '
            <div id="message" class="success">
                Personal registrado con éxito!.
            </div>
            <script>
                setTimeout(() => {
                    window.location.href = "../views/registrar_personal.php";
                }, 3000);
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
            </style>
            ';
            exit();
        } else {
            echo '
            <div id="message" class="error">
                Error al ingresar el personal.
            </div>
            <script>
                setTimeout(() => {
                    window.location.href = "../views/registrar_personal.php";
                }, 3000);
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
                    background-color: #f44336; /* Rojo */
                    color: white;
                    padding: 30px 60px;
                    border-radius: 15px;
                    font-size: 24px; /* Tamaño más grande */
                    box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2);
                    text-align: center;
                }
            </style>
            ';
            exit();
        }
?>


