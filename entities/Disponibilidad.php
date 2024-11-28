<?php
class Disponibilidad {
    private $conn;
    private $table_name = "Disponibilidad";

    public $id_disponibilidad;
    public $id_personal;
    public $fecha;
    public $hora_inicio;
    public $hora_fin;
    public $estado;

    public function __construct($db) {
        $this->conn = $db;
    }
    public function verificarDisponibilidadAsignada() {
        $query = "SELECT COUNT(*) as total FROM citas WHERE id_disponibilidad = :id_disponibilidad";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_disponibilidad", $this->id_disponibilidad);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'] > 0;
    }
    
    // Crear un nuevo registro de disponibilidad
    public function crearDisponibilidad() {
        $query = "INSERT INTO disponibilidad (id_personal, fecha, hora_inicio, hora_fin, estado) 
                  VALUES (:id_personal, :fecha, :hora_inicio, :hora_fin, :estado)";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":id_personal", $this->id_personal);
        $stmt->bindParam(":fecha", $this->fecha);
        $stmt->bindParam(":hora_inicio", $this->hora_inicio);
        $stmt->bindParam(":hora_fin", $this->hora_fin);
        $stmt->bindParam(":estado", $this->estado);
    
        return $stmt->execute();
    }
    

    // Leer todos los registros de disponibilidad
    public function leerDisponibilidades() {
        $query = "SELECT * FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    // Leer un registro de disponibilidad por ID
    public function leerDisponibilidad() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_disponibilidad = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_disponibilidad);
        $stmt->execute();

        return $stmt;
    }

    // Actualizar un registro de disponibilidad
    public function actualizarEstado() {
        $query = "UPDATE disponibilidad SET estado = :estado WHERE id_disponibilidad = :id_disponibilidad";
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(":estado", $this->estado);
        $stmt->bindParam(":id_disponibilidad", $this->id_disponibilidad);
    
        return $stmt->execute();
    }
    

    // Eliminar un registro de disponibilidad
    public function eliminarDisponibilidad() {
        // ... Implementación similar a la entidad Cita ...
    }
}