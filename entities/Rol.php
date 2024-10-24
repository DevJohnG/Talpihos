<?php
class Rol {
    public $id_rol;
    public $nombre_rol;
    public $descripcion;

    public function __construct($id_rol, $nombre_rol, $descripcion) {
        $this->id_rol = $id_rol;
        $this->nombre_rol = $nombre_rol;
        $this->descripcion = $descripcion;
    }
}
?>

