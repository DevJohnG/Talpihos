<?php
require_once '../entities/Persona.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $db = (new Database())->getConnection();

    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $genero = $_POST['genero'];
    $nacionalidad = $_POST['nacionalidad'];

    try {
        $persona = new Persona($db, $cedula, $nombre, $apellido, $fechaNacimiento, $genero, $nacionalidad);
    
        if ($persona->registrar()) {
            echo '
            <div id="message" class="success">
                Persona registrada con éxito.
            </div>
            <script>
                setTimeout(() => {
                    window.location.href = "../views/registro_personas.php";
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
                    background-color: #00FF00; /* Verde chillón */
                    color: white;
                    padding: 30px 60px;
                    border-radius: 15px;
                    font-size: 24px; /* Tamaño más grande */
                    box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.2);
                    text-align: center;
                }
                #message.success {
                    background-color: #02D12B; /* Verde chillón */
                }
                #message.error {
                    background-color: #f44336; /* Color de error */
                }
            </style>
            ';
            exit();
        } else {
            echo '
            <div id="message" class="error">
                Error al registrar la persona.
            </div>
            <script>
                setTimeout(() => {
                    window.location.href = "../views/registro_personas.php";
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
                #message.success {
                    background-color: #02D12B; /* Verde chillón */
                }
                #message.error {
                    background-color: #f44336; /* Color de error */
                }
            </style>
            ';
            exit();
        }
        
        
        
    } catch (Exception $e) {
        echo("error" . urlencode($e->getMessage()));
        exit();
    }
    
}
