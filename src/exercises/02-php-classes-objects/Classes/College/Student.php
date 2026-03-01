<?php
namespace College;

class Student {
    private static $students = [];
    
    public $name;
    public $number;

    public function __construct($name, $number) {
        $this->name = $name;
        $this->number = $number;

        // Add this student to the static registry
        self::$students[$number] = $this;
        echo "Creating student: {$this->name}<br>";
    }

    public static function getCount() {
        return count(self::$students);
    }

    public static function findAll() {
        return self::$students;
    }

    public static function findByNumber($num) {
        return self::$students[$num] ?? null;
    }

    public function leave() {
        unset(self::$students[$this->number]);
        echo "Destroying student: {$this->name}<br>";
    }

    public function __destruct() {
        echo "Student {$this->name} has been destroyed<br>";
    }

    public function __toString() {
        return "Name: {$this->name}, Number: {$this->number}";
    }
}