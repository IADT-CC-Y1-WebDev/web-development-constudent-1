<?php
require_once 'php/lib/config.php';
require_once 'php/classes/Book.php';

startSession();

try {
    $data = [];
    $errors = [];
    
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'id' => $_GET['id'] ?? null
    ];

    $rules = [
        'id' => 'required|integer'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    $Book = Book::findById($data['id']);
    if (!$Book) {
        throw new Exception('Book not found.');
    }

    if ($Book->image_filename) {
        $uploader = new ImageUpload();
        $uploader->deleteImage($Book->image_filename);
    }

    $Book->delete();


    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Book deleted successfully.');

    redirect('index.php');
}
catch (Exception $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    setFormData($data);
    setFormErrors($errors);

    if (isset($data['id']) && $data['id']) {
        redirect('Book_view.php?id=' . $data['id']);
    }
    else {
        redirect('index.php');
    }
}
