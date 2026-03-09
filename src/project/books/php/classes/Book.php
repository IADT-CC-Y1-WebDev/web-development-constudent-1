<?php

class Book {
    public $id;
    public $title;
    public $published_year;
    public $author_id;
    public $description;
    public $image_filename;

    private $db;

    public function __construct($data = []) {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->title = $data['title'] ?? null;
            $this->published_year = $data['published_year'] ?? null;
            $this->author_id = $data['author_id'] ?? null;
            $this->description = $data['description'] ?? null;
            $this->image_filename = $data['image_filename'] ?? null;
        }
    }

    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books ORDER BY title");
        $stmt->execute();

        $books = [];
        while ($row = $stmt->fetch()) {
            $books[] = new Book($row);
        }

        return $books;
    }

    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Book($row);
        }

        return null;
    }


    public function save() {

        if ($this->id) {
            
            $stmt = $this->db->prepare("
                UPDATE books
                SET title = :title,
                    published_year = :published_year,
                    author_id = :author_id,
                    description = :description,
                    image_filename = :image_filename
                WHERE id = :id
            ");

            $params = [
                'title' => $this->title,
                'published_year' => $this->published_year,
                'author_id' => $this->author_id,
                'description' => $this->description,
                'image_filename' => $this->image_filename,
                'id' => $this->id
            ];
        } 
        else {
            
            $stmt = $this->db->prepare("
                INSERT INTO books (title, published_year, author_id, description, image_filename)
                VALUES (:title, :published_year, :author_id, :description, :image_filename)
            ");

            $params = [
                'title' => $this->title,
                'published_year' => $this->published_year,
                'author_id' => $this->author_id,
                'description' => $this->description,
                'image_filename' => $this->image_filename
            ];
        }

        $status = $stmt->execute($params);

        if (!$status) {
            $error_info = $stmt->errorInfo();
            $message = sprintf(
                "SQLSTATE error code: %d; error message: %s",
                $error_info[0],
                $error_info[2]
            );
            throw new Exception($message);
        }

        if ($stmt->rowCount() !== 1) {
            throw new Exception("Failed to save book.");
        }

        if ($this->id === null) {
            $this->id = $this->db->lastInsertId();
        }
    }

    public function delete() {
        if (!$this->id) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }

    
    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'published_year' => $this->published_year,
            'author_id' => $this->author_id,
            'description' => $this->description,
            'image_filename' => $this->image_filename
        ];
    }
}