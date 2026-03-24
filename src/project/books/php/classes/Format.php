<?php
class Format {
    public $id;
    public $name;

    public function __construct($data = []) {
        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
        }
    }

    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM formats ORDER BY name ASC");
        $stmt->execute();
        
        $formats = [];
        while ($row = $stmt->fetch()) {
            $formats[] = new Format($row);
        }
        return $formats;
    }

    public static function findByBook($bookId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT f.* FROM formats f
            JOIN book_format bf ON f.id = bf.format_id
            WHERE bf.book_id = :book_id
        ");
        $stmt->execute(['book_id' => $bookId]);
        
        $formats = [];
        while ($row = $stmt->fetch()) {
            $formats[] = new Format($row);
        }
        return $formats;
    }
}