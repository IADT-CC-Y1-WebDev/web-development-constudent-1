<?php
require_once 'DB.php';

class Publisher {
    public $id;
    public $name;

    public static function findAll() {
        $dbInstance = DB::getInstance(); 
        $pdo = $dbInstance->getConnection();
        $stmt = $pdo->query("SELECT * FROM publishers ORDER BY name ASC");
        
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Publisher');
    }
    
    public static function find($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Publisher');
        $publisher = $stmt->fetch();

        return $publisher ?: null;
    }
}