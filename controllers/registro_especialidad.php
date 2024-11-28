<?php
require_once '../config/Database.php'; 

$db = new Database();
$conn = $db->getConnection();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $nombre_especialidad = $_POST['nombre_especialidad'];
    $descripcion_especialidad = $_POST['descripcion_especialidad'];
    $id_subEspecialidad = $_POST['id_subEspecialidad'];
    $id_area_medica = $_POST['id_area_medica']; 

    
    $query = "INSERT INTO Especialidades (nombre_especialidad, descripcion_especialidad, id_subEspecialidad, id_area_medica) 
              VALUES (:nombre_especialidad, :descripcion_especialidad, :id_subEspecialidad, :id_area_medica)";

    
    $stmt = $conn->prepare($query);

    $stmt->bindParam(':nombre_especialidad', $nombre_especialidad);
    $stmt->bindParam(':descripcion_especialidad', $descripcion_especialidad);
    $stmt->bindParam(':id_subEspecialidad', $id_subEspecialidad);
    $stmt->bindParam(':id_area_medica', $id_area_medica);


    if ($stmt->execute()) {
        echo '
        <div id="message" class="success">
            Especialidad registrada con éxito!.
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
                background-color: #02D12B; /* Verde chillón */
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
            Error al registrar la Especialidad.
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
    exit; 
}


if (isset($_GET['id_area_medica'])) {
    $id_area_medica = $_GET['id_area_medica'];

    $query = "SELECT * FROM sub_especialidades WHERE id_area_medica = :id_area_medica";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_area_medica', $id_area_medica);
    $stmt->execute();

    $subespecialidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($subespecialidades) {
        echo json_encode($subespecialidades);
    } else {
        echo json_encode([]);
    }
    exit; 
}
echo "No se ha enviado un id_area_medica válido.";
?>