<?php
require_once 'php/lib/config.php';
require_once 'php/classes/Book.php';

startSession();

try {

    $data = [];
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'title' => $_POST['title'] ?? null,
        'published_year' => $_POST['published_year'] ?? null,
        'Author_id' => $_POST['Author_id'] ?? null,
        'description' => $_POST['description'] ?? null,
        'platform_ids' => $_POST['platform_ids'] ?? [],
        'image' => $_FILES['image'] ?? null
    ];

    $rules = [
        'title' => 'required|notempty|min:1|max:255',
        'published_year' => 'required|notempty',
        'Author_id' => 'required|integer',
        'description' => 'required|notempty|min:10|max:5000',
        'platform_ids' => 'required|array|min:1|max:10',
        'image' => 'required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
       
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    $Author = Author::findById($data['Author_id']);
    if (!$Author) {
        throw new Exception('Selected Author does not exist.');
    }

    $uploader = new ImageUpload();
    $imageFilename = $uploader->process($_FILES['image']);

    if (!$imageFilename) {
        throw new Exception('Failed to process and save the image.');
    }

    $Book = new Book();
    $Book->title = $data['title'];
    $Book->published_year = $data['published_year'];
    $Book->Author_id = $data['Author_id'];
    $Book->description = $data['description'];
    $Book->image_filename = $imageFilename;

    $Book->save();


    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Book stored successfully.');

    redirect('Book_view.php?id=' . $Book->id);
}
catch (Exception $e) {
    if (isset($imageFilename) && $imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    setFlashMessage('error', 'Error: ' . $e->getMessage());

    setFormData($data);
    setFormErrors($errors);

    redirect('Book_create.php');
}
