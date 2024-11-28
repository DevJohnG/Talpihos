<?php

require_once '../config/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cedula = $_POST['cedula'];
    $id_tipo_sangre = $_POST['id_tipo_sangre'];

    try {

        // Verificar si la cédula ya existe en la tabla persona
        $sql_check_persona = "SELECT * FROM persona WHERE cedula = :cedula";
        $stmt_check_persona = $conn->prepare($sql_check_persona);
        $stmt_check_persona->bindParam(':cedula', $cedula);
        $stmt_check_persona->execute();

        if ($stmt_check_persona->rowCount() == 0) {
            // Si no existe, mostrar un mensaje de error
            echo '
            <div id="message" class="error">
                El paciente con esta cédula no existe.
            </div>
            <script>
                setTimeout(() => {
                    window.location.href = "../views/registro_paciente.php";
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

        // Verificar si ya existe un paciente con la misma cédula en la tabla Pacientes
        $sql_check_paciente = "SELECT * FROM Pacientes WHERE cedula = :cedula";
        $stmt_check_paciente = $conn->prepare($sql_check_paciente);
        $stmt_check_paciente->bindParam(':cedula', $cedula);
        $stmt_check_paciente->execute();

        if ($stmt_check_paciente->rowCount() > 0) {
            // Si ya existe un paciente con esta cédula, mostrar un mensaje de error
            echo '
            <div id="message" class="error">
                Ya existe un paciente con esta cédula registrada.
            </div>
            <script>
                setTimeout(() => {
                    window.location.href = "../views/registro_paciente.php";
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


        $sql = "INSERT INTO Pacientes (cedula, id_tipo_sangre) VALUES (:cedula, :id_tipo_sangre)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':cedula', $cedula);
        $stmt->bindParam(':id_tipo_sangre', $id_tipo_sangre);

        if ($stmt->execute()) {
            echo '
            <div id="message" class="success">
                Paciente registrado con éxito!.
            </div>
            <script>
                setTimeout(() => {
                    window.location.href = "../views/registro_paciente.php";
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
                Error al ingresar el paciente.
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
            </style>
            ';
            exit();
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>
