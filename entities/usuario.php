<?php
class Usuario {
    public $id_usuario;
    public $username;
    public $password;
    public $rol;

    public function __construct($id_usuario, $username, $password, $rol) {
        $this->id_usuario = $id_usuario;
        $this->username = $username;
        $this->password = $password;
        $this->rol = $rol;
    }
}
?>

