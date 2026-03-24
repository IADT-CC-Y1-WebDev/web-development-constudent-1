<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';
require_once 'php/classes/Book.php';
require_once 'php/classes/Publisher.php';
require_once 'php/classes/Validator.php';
require_once 'php/classes/ImageUpload.php';

startSession();

try {
    $data = [];
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'title' => $_POST['title'] ?? null,
        'author' => $_POST['author'] ?? null,
        'year' => $_POST['year'] ?? null,
        'publisher_id' => $_POST['publisher_id'] ?? null,
        'description' => $_POST['description'] ?? null,
        'isbn' => $_POST['isbn'] ?? null,
        'format_ids' => $_POST['format_ids'] ?? [],
        'cover' => $_FILES['cover'] ?? null
    ];

    $year = date("Y");
    $rules = [
        'title' => 'required|notempty|min:3|max:255',
        'author' => 'required|notempty|min:5|max:255',
        'year' => 'required|notempty|minvalue:1900|maxvalue:' . $year,
        'publisher_id' => 'required|integer',
        'description' => 'required|notempty|min:10|max:5000',
        'isbn' => 'required|notempty|min:13|max:13',
        'format_ids' => 'required|array|min:1|max:10',
        'cover' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }
        throw new Exception('Validation failed.');
    }

    $publisher = Publisher::findById($data['publisher_id']);
    if (!$publisher) {
        throw new Exception('Selected Publisher does not exist.');
    }

    $uploader = new ImageUpload();
    $imageFilename = $uploader->process($_FILES['cover']);

    if (!$imageFilename) {
        throw new Exception('Failed to process and save the image.');
    }

    $book = new Book();
    $book->title = $data['title'];
    $book->year = $data['year'];
    $book->publisher_id = $data['publisher_id'];
    $book->description = $data['description'];
    $book->isbn = $data['isbn'];
    $book->cover_filename = $imageFilename;

    $book->save();

    if (!empty($data['format_ids'])) {
        $book->setFormats($data['format_ids']);
    }

    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Book stored successfully.');
    redirect('book_view.php?id=' . $book->id);

} catch (Exception $e) {
    if (isset($imageFilename) && $imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    setFlashMessage('error', $e->getMessage());
    setFormData($data);
    setFormErrors($errors);

    redirect('book_create.php');
}