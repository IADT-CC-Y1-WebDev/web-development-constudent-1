<?php

class Book {
    public $id;
    public $title;
    public $author;
    public $publisher_id;
    public $year;
    public $isbn;
    public $description;
    public $cover_filename;

    private $db;

    public function __construct($data = []) {
        $this->db = DB::getInstance()->getConnection();
        
        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->title = $data['title'] ?? null;
            $this->author = $data['author'] ?? null;
            $this->publisher_id = $data['publisher_id'] ?? null;
            $this->year = $data['year'] ?? null;
            $this->isbn = $data['isbn'] ?? null;
            $this->description = $data['description'] ?? null;
            $this->cover_filename = $data['cover_filename'] ?? null;
        }
    }

    public static function find($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Book($row) : null;
    }

    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books ORDER BY title ASC");
        $stmt->execute();
        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($row);
        }
        return $books;
    }

    public function save() {
        $params = [
            'title'          => $this->title,
            'author'         => $this->author,
            'publisher_id'   => $this->publisher_id,
            'year'           => $this->year,
            'isbn'           => $this->isbn,
            'description'    => $this->description,
            'cover_filename' => $this->cover_filename,
        ];

        if ($this->id !== null) {
            $sql = "UPDATE books SET 
                    title = :title, 
                    author = :author,
                    publisher_id = :publisher_id,
                    year = :year,
                    isbn = :isbn,
                    description = :description,
                    cover_filename = :cover_filename
                    WHERE id = :id";

            $params['id'] = $id;
        }
        else {
            $sql = "INSERT INTO books(title, author, publisher_id, year, isbn, description, cover_filename) 
                    VALUES (:title, :author, :publisher_id, :year, :isbn, :description, :cover_filename)";
        }
                
        $stmt = $this->db->prepare($sql);
        
        $status = $stmt->execute($params);

        // Check for errors
        if (!$status) {
            $error_info = $stmt->errorInfo();
            $message = sprintf(
                "SQLSTATE error code: %d; error message: %s",
                $error_info[0],
                $error_info[2]
            );
            throw new Exception($message);  
        }

        // Ensure one row affected
        if ($stmt->rowCount() !== 1) {
            throw new Exception("Failed to save book.");
        }

        // Set ID for new records
        if ($this->id === null) {
            $this->id = $this->db->lastInsertId();
        }        
    }

    public function delete() {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        return $stmt->execute(['id' => $this->id]);
    }

    public function setFormats($formatId) {

    }
}