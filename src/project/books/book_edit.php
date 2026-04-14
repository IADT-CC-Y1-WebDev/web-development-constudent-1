<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/utils.php';
require_once 'php/lib/forms.php';

startSession();

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }
    if (!isset($_GET['id'])) {
        throw new Exception('No book ID provided.');
    }

    $id = $_GET['id'];
    $book = Book::find($id);
    
    if (!$book) {
        throw new Exception("Book not found.");
    }

    $authors = Author::findAll();
}
catch (Exception $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <?php require 'php/inc/head_content.php'; ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="width-12">
                <?php require 'php/inc/flash_message.php'; ?>
                <h1>Edit Book</h1>
            </div>
        </div>

        <form action="book_update.php" method="POST" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="id" value="<?= $book->id ?>">

            <div class="row input">
                <div class="width-4 text-right">
                    <label for="title">Title:</label>
                </div>
                <div class="width-8">
                    <input type="text" name="title" id="title" value="<?= h(old('title', $book->title)) ?>">
                </div>
            </div>

            <div class="row input">
                <div class="width-4 text-right">
                    <label for="author">Author:</label>
                </div>
                <div class="width-8">
                    <input type="text" name="author" id="author" value="<?= h(old('author', $book->author)) ?>">
                </div>
            </div>

            <div class="row input">
                <div class="width-4 text-right">
                    <label for="year">Year:</label>
                </div>
                <div class="width-8">
                    <input type="text" name="year" id="year" value="<?= h(old('year', $book->year)) ?>">
                </div>
            </div>

            <div class="row input">
                <div class="width-4 text-right">
                    <label for="isbn">ISBN:</label>
                </div>
                <div class="width-8">
                    <input type="text" name="isbn" id="isbn" value="<?= h(old('isbn', $book->isbn)) ?>">
                </div>
            </div>

            <div class="row input">
                <div class="width-4 text-right">
                    <label for="author_id">Publisher:</label>
                </div>
                <div class="width-8">
                    <select name="author_id" id="author_id">
                        <option value="">Select a Publisher</option>
                        <?php foreach ($authors as $a): ?>
                            <?php 
                                $selected = (isset($book->publisher_id) && $book->publisher_id == $a->id) ? 'selected' : ''; 
                            ?>
                            <option value="<?= $a->id ?>" <?= $selected ?>>
                                <?= h($a->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row input">
                <div class="width-4 text-right">
                    <label for="description">Description:</label>
                </div>
                <div class="width-8">
                    <textarea name="description" id="description"><?= h(old('description', $book->description)) ?></textarea>
                </div>
            </div>

            <div class="row input">
                <div class="width-4 text-right">
                    <label>Current Cover:</label>
                </div>
                <div class="width-8">
                    <?php if ($book->cover_filename): ?>
                        <div class="edit-image-preview">
                            <img src="uploads/<?= h($book->cover_filename) ?>" alt="Cover" style="max-width: 250px; display: block;">
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row input">
                <div class="width-4 text-right">
                    <label for="image">Image (optional):</label>
                </div>
                <div class="width-8">
                    <input type="file" name="image" id="image">
                </div>
            </div>

            <div class="row">
                <div class="width-4"></div>
                <div class="width-8 form-actions">
                    <button type="submit" class="button">Update Book</button>
                    <a href="index.php" class="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <?php 
    clearFormData();
    clearFormErrors();
    ?>
</body>
</html>