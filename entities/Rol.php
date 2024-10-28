<?php
class Rol {
    private $id_rol;
    private $nombre_rol;
    private $descripcion;

    public function __construct($id_rol, $nombre_rol, $descripcion) {
        $this->id_rol = $id_rol;
        $this->nombre_rol = $nombre_rol;
        $this->descripcion = $descripcion;
    }

    public function getIdRol() {
        return $this->id_rol;
    }

    public function getNombreRol() {
        return $this->nombre_rol;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }


    public function hasPermission($permissionName, $db) {
        $query = $db->prepare("SELECT p.nombre_permiso FROM Permisos p 
                               INNER JOIN roles_permisos rp ON rp.id_permiso = p.id_permiso 
                               WHERE rp.id_rol = ?");
        $query->execute([$this->id_rol]);
        $permissions = $query->fetchAll();

        foreach ($permissions as $permiso) {
            if ($permiso['nombre_permiso'] === $permissionName) {
                return true;
            }
        }
        return false;
    }
}


