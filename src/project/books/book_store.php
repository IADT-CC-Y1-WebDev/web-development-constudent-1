<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/utils.php';
require_once 'php/lib/forms.php';

startSession();

try {

    $data = [];
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'title'        => $_POST['title'] ?? null,
        'author'       => $_POST['author'] ?? null,
        'publisher_id' => $_POST['publisher_id'] ?? null,
        'year'         => $_POST['year'] ?? null,
        'isbn'         => $_POST['isbn'] ?? null,
        'description'  => $_POST['description'] ?? null
    ];

    $rules = [
        'title'        => 'required|notempty',
        'author'       => 'required|notempty',
        'publisher_id' => 'required|integer',
        'year'         => 'required|integer',
        'isbn'         => 'required|notempty',
        'description'  => 'required|notempty'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
         foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    $Book = new Book();
    $Book->title        = $data['title'];
    $Book->author       = $data['author'];
    $Book->publisher_id = $data['publisher_id'];
    $Book->year         = $data['year'];
    $Book->isbn         = $data['isbn'];
    $Book->description  = $data['description'];

    if (isset($_FILES['cover']) && $_FILES['cover']['error'] === UPLOAD_ERR_OK) {
        $uploader = new ImageUpload();
        $filename = $uploader->process($_FILES['cover']);
        if ($filename) {
            $Book->cover_filename = $filename;
        }
    }

    $Book->save();

    if (isset($_POST['format_ids']) && is_array($_POST['format_ids'])) {
        foreach ($_POST['format_ids'] as $formatId) {
            $Book->setFormats($formatId);
        }
    }

    clearFormData();
    clearFormErrors();
    setFlashMessage('success', 'New book saved successfully.');
    redirect('index.php');

} catch (Exception $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    setFormData($data);
    setFormErrors($errors);
    redirect('book_create.php');
}