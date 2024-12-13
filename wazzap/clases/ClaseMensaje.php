<?php
class Mensaje {
    private $id;
    private $text;
    private $date;
    private $contact_id;

    public function __construct($id, $text, $date, $contact_id) {
        $this->id = $id;
        $this->text = $text;
        $this->date = $date;
        $this->contact_id = $contact_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getText() {
        return $this->text;
    }

    public function getDate() {
        return $this->date;
    }

    public function getContactId() {
        return $this->contact_id;
    }
}