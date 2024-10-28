<?php
require_once '../config/Database.php';

class Persona {
    private $idPersona;
    private $cedula;
    private $nombre;
    private $apellido;
    private $fechaNacimiento;
    private $genero;
    private $nacionalidad;

    public function __construct($cedula, $nombre, $apellido, $fechaNacimiento, $genero, $nacionalidad) {
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->genero = $genero;
        $this->nacionalidad = $nacionalidad;
    }

    public function registrar() {
        $database = new Database();
        $conn = $database->getConnection();

        $sql = "INSERT INTO Persona (cedula, nombre, apellido, fecha_nacimiento, genero, nacionalidad) 
                VALUES (:cedula, :nombre, :apellido, :fecha_nacimiento, :genero, :nacionalidad)";
        
        $stmt = $conn->prepare($sql);
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
