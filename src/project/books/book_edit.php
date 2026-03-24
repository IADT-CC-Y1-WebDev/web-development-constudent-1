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
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('No book ID provided.');
    }

    $id = $_GET['id'];

    $book = Book::findAll($id);
    if ($book === null) {
        throw new Exception("Book not found.");
    }

    $authors = Author::findAll();
    $publishers = Publisher::findAll();
}
catch (PDOException $e) {
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

        <form action="book_update.php" method="POST" enctype="multipart/form-data" class="row" novalidate>
            <input type="hidden" name="id" value="<?= $book->id ?>">

            <div class="width-8">
                <div class="input">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="<?= h(old('title', $book->title)) ?>">
                </div>

                <div class="input">
                    <label for="year">Year</label>
                    <input type="text" name="year" id="year" value="<?= h(old('year', $book->year)) ?>">
                </div>

                <div class="input">
                    <label for="author_id">Author</label>
                    <select name="author_id" id="author_id">
                        <?php foreach ($authors as $a): ?>
                            <option value="<?= $a->id ?>" <?= chosen('author_id', $book->author_id, $a->id) ? 'selected' : '' ?>>
                                <?= h($a->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="input">
                    <label for="description">Description</label>
                    <textarea name="description" id="description"><?= h(old('description', $book->description)) ?></textarea>
                </div>
            </div>

            <div class="width-4">
                <div class="input">
                    <label>Current Cover</label>
                    <?php if ($book->cover_filename): ?>
                        <img src="uploads/<?= h($book->cover_filename) ?>
                    <?php endif; ?>
                    <label for="image">Change Cover</label>
                    <input type="file" name="image" id="image">
                </div>

                <button type="submit" class="button">Update Book</button>
                <a href="index.php" class="button">Cancel</a>
            </div>
        </form>
    </div>
    <?php 
    clearFormData();
    clearFormErrors();
    ?>
</body>
</html>