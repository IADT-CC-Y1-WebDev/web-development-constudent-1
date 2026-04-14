<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/utils.php';
require_once 'php/lib/forms.php';

startSession();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }
    $data = [
    'id'           => $_POST['id'] ?? null,
    'title'        => $_POST['title'] ?? null,
    'author'       => $_POST['author'] ?? null,
    'isbn'         => $_POST['isbn'] ?? null,
    'year'         => $_POST['year'] ?? null,
    'publisher_id' => $_POST['author_id'] ?? null, 
    'description'  => $_POST['description'] ?? null,
    'image'        => $_FILES['image'] ?? null
];

$rules = [
    'id'           => 'required|integer',
    'title'        => 'required|notempty',
    'author'       => 'required|notempty',        
    'isbn'         => 'required|notempty',        
    'year'         => 'required|integer',
    'publisher_id' => 'required|integer',
    'description'  => 'required|notempty'
];

    

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        setFormErrors($validator->errors());
        setFormData($data);
        throw new Exception('Validation failed.');
    }

    $Book = Book::find($data['id']);
    if (!$Book) {
        throw new Exception('Book not found.');
    }

    $uploader = new ImageUpload();
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        if (!empty($Book->cover_filename)) {
            $uploader->deleteImage($Book->cover_filename);
        }
        $newFile = $uploader->process($_FILES['image']);
        if ($newFile) {
            $Book->cover_filename = $newFile;
        }
    }
    
    

   $Book = Book::find($data['id']);

if ($Book) {
    $Book->title        = $data['title'];
    $Book->author       = $data['author'];      
    $Book->isbn         = $data['isbn'];         
    $Book->year         = $data['year'];
    $Book->publisher_id = $data['publisher_id'];
    $Book->description  = $data['description'];

    if ($imageFilename) {
        $Book->cover_filename = $imageFilename;
    }

    $Book->save();
}

    clearFormData();
    clearFormErrors();
    setFlashMessage('success', 'Book updated successfully.');
    redirect('book_view.php?id=' . $Book->id);

} catch (Exception $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    $id = $_POST['id'] ?? '';
    redirect("book_edit.php?id=$id");
}