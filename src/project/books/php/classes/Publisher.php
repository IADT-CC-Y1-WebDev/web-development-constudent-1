<?php
require_once 'DB.php';

class Publisher {
    public $id;
    public $name;

    public static function findAll() {
        // 1. Get the DB instance
        $dbInstance = DB::getInstance(); 
        
        // 2. Get the ACTUAL connection from that instance
        $pdo = $dbInstance->getConnection();
        
        // 3. Now you can call query() on $pdo
        $stmt = $pdo->query("SELECT * FROM publishers ORDER BY name ASC");
        
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Publisher');
    }
}