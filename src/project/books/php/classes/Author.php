<?php

class Author {
    public $id;
    public $name;
    private $db;

    public function __construct($data = []) {
        $this->db = DB::getInstance()->getConnection();
        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
        }
    }

    public static function findById($id) {
        $db = DB::getInstance()->getConnection(); 
        $stmt = $db->prepare("SELECT * FROM publishers WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();

        if ($row) {
            return new Author($row);
        }
        return null;
    }

    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers ORDER BY name ASC");
        $stmt->execute();
        $authors = [];
        while ($row = $stmt->fetch()) {
            $authors[] = new Author($row);
        }
        return $authors;
    }
}