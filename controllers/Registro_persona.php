<?php
require_once '../entities/Persona.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $genero = $_POST['genero'];
    $nacionalidad = $_POST['nacionalidad'];

    $persona = new Persona($cedula, $nombre, $apellido, $fechaNacimiento, $genero, $nacionalidad);

    if ($persona->registrar()) {
        echo "Persona registrada con éxito.";
    } else {
        echo "Error al registrar la persona.";
    }
}
?>
