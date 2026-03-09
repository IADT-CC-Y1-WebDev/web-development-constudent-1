<?php
namespace College;

require_once 'Student.php';

class Undergrad extends Student {
    public $course;
    public $year;

    public function __construct($name, $number, $course, $year) {
        parent::__construct($name, $number);
        $this->course = $course;
        $this->year = $year;
    }

    public function __toString() {
        return "Undergrad: {$this->name} ({$this->number}), Course: {$this->course}, Year: {$this->year}";
    }
}