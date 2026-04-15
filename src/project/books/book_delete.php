<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/utils.php';
require_once 'php/classes/Book.php';
require_once 'php/classes/Validator.php';
require_once 'php/classes/ImageUpload.php';

startSession();

try {
    $data = [
        'id' => $_GET['id'] ?? null
    ];

    $rules = [
        'id' => 'required'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        throw new Exception('Invalid Book ID.');
    }

    $Book = Book::find($data['id']);
    
    if (!$Book) {
        throw new Exception('Book not found.');
    }

    if ($Book->image_filename) {
        $uploader = new ImageUpload();
        $uploader->deleteImage($Book->image_filename);
    }

    $Book->delete();

    setFlashMessage('success', 'Book deleted successfully.');
    
    redirect('index.php');

} catch (Exception $e) {
    setFlashMessage('error', $e->getMessage());
    redirect('index.php');
}