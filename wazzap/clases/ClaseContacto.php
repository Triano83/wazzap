<?php
class Contacto {
    private $id;
    private $name;
    private $surname;
    private $phone;
    private $pic;
    private $id_user;

    public function __construct($id, $name, $surname, $phone, $pic, $id_user) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->pic = $pic;
        $this->id_user = $id_user;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getPic() {
        return $this->pic;
    }

    public function getIdUser() {
        return $this->id_user;
    }
}