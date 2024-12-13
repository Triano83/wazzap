<?php
/* CLASEUSUARIO.PHP */
/* PHP 5 Creamos la clase usuario */
class Usuario {
    private $id;
    private $telefono;
    private $password;
    private $pic;

    public function __construct($id, $telefono, $password, $pic) {
        $this->id = $id;
        $this->telefono = $telefono;
        $this->password = $password;
        $this->pic = $pic;
    }

    public function getId() {
        return $this->id;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPic() {
        return $this->pic;
    }
}