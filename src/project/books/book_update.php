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
        'id' => $_POST['id'] ?? null,
        'title' => $_POST['title'] ?? null,
        'published_year' => $_POST['published_year'] ?? null,
        'author_id' => $_POST['author_id'] ?? null,
        'description' => $_POST['description'] ?? null,
        'image' => $_FILES['image'] ?? null
    ];

    $rules = [
        'id' => 'required|integer',
        'title' => 'required|notempty|min:1|max:255',
        'published_year' => 'required|notempty',
        'author_id' => 'required|integer',
        'description' => 'required|notempty|min:10|max:5000',
        'image' => 'file|image|mimes:jpg,jpeg,png|max_file_size:5242880' 
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

   
    $Author = Author::findById($data['author_id']);
    if (!$Author) {
        throw new Exception('Selected Author does not exist.');
    }


    
    $imageFilename = null;
    $uploader = new ImageUpload();
    if ($uploader->hasFile('image')) {
        $uploader->deleteImage($Book->image_filename);
        $imageFilename = $uploader->process($_FILES['image']);
        if (!$imageFilename) {
            throw new Exception('Failed to process and save the image.');
        }
    }
    
    $Book->title = $data['title'];
    $Book->published_year = $data['published_year'];
    $Book->author_id = $data['author_id'];
    $Book->description = $data['description'];
    if ($imageFilename) {
        $Book->image_filename = $imageFilename;
    }

    $Book->save();

    BookPlatform::deleteByBook($Book->id);

    clearFormData();
    clearFormErrors();
    setFlashMessage('success', 'Book updated successfully.');

    redirect('Book_view.php?id=' . $Book->id);
}
catch (Exception $e) {
    if ($imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    setFlashMessage('error', 'Error: ' . $e->getMessage());

    setFormData($data);
    setFormErrors($errors);

    if (isset($data['id']) && $data['id']) {
        redirect('Book_edit.php?id=' . $data['id']);
    }
    else {
        redirect('index.php');
    }
}

?>