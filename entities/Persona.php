<?php
require_once '../config/Database.php';

class Persona {
    private $db;
    private $cedula;
    private $nombre;
    private $apellido;
    private $fechaNacimiento;
    private $genero;
    private $nacionalidad;

    public function __construct($db, $cedula, $nombre, $apellido, $fechaNacimiento, $genero, $nacionalidad) {
        $this->db = $db;
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->genero = $genero;
        $this->nacionalidad = $nacionalidad;
    }

    public function registrar() {
        $checkQuery = "SELECT cedula FROM persona WHERE cedula = :cedula";
        $checkStmt = $this->db->prepare($checkQuery);
        $checkStmt->bindParam(':cedula', $this->cedula);
        $checkStmt->execute();

        if ($checkStmt->rowCount() > 0) {
            throw new Exception("La cédula ya está registrada.");
        }

        // Insertar la nueva persona
        $query = "INSERT INTO persona (cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad) 
                  VALUES (:cedula, :nombre, :apellido, :fecha_nacimiento, :genero, :nacionalidad)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':cedula', $this->cedula);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':fecha_nacimiento', $this->fechaNacimiento);
        $stmt->bindParam(':genero', $this->genero);
        $stmt->bindParam(':nacionalidad', $this->nacionalidad);

        return $stmt->execute();
    }
}
?>
