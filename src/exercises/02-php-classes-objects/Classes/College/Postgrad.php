<?php
namespace College;

require_once 'Student.php';

class Postgrad extends Student {
    public $supervisor;
    public $topic;

    public function __construct($name, $number, $supervisor, $topic) {
        parent::__construct($name, $number);
        $this->supervisor = $supervisor;
        $this->topic = $topic;
    }

    public function __toString() {
        return "Postgrad: {$this->name} ({$this->number}), Supervisor: {$this->supervisor}, Topic: {$this->topic}";
    }
}