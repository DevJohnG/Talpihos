<?php
class Cita {
    private $conn;
    private $table_name = "Citas";

    public $id_cita;
    public $descripcion;
    public $estado;
    public $id_paciente;
    public $id_personal;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function leerCitas() {
        $query = "SELECT * FROM " . $this->table_name;
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt;
    }
    
    public function crearCita() {
        $query = "INSERT INTO " . $this->table_name . " (descripcion, estado, id_paciente, id_personal, id_disponibilidad) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
    
        try {
            $stmt->execute([$this->descripcion, $this->estado, $this->id_paciente, $this->id_personal, $this->id_disponibilidad]);
            return $stmt->rowCount() > 0; // Devuelve true si se insertó al menos una fila
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function actualizarCita() {
        $query = "UPDATE Citas SET 
                    descripcion = COALESCE(:descripcion, descripcion),
                    estado = COALESCE(:estado, estado),
                    id_paciente = COALESCE(:id_paciente, id_paciente),
                    id_personal = COALESCE(:id_personal, id_personal),
                    id_disponibilidad = COALESCE(:id_disponibilidad, id_disponibilidad)
                  WHERE id_cita = :id_cita";
    
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':estado', $this->estado);
        $stmt->bindParam(':id_paciente', $this->id_paciente);
        $stmt->bindParam(':id_personal', $this->id_personal);
        $stmt->bindParam(':id_cita', $this->id_cita);
        $stmt->bindParam(':id_disponibilidad', $this->id_disponibilidad);
    
        return $stmt->execute();
    }
    
    public function eliminarCita() {
        $query = "DELETE FROM Citas WHERE id_cita = :id_cita";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cita', $this->id_cita);
    
        return $stmt->execute();
    }
    
}
?>
