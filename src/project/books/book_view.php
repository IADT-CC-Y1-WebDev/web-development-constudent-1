<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/utils.php';
require_once 'php/classes/Book.php';
require_once 'php/classes/Publisher.php';
require_once 'php/classes/Format.php';

startSession();

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !array_key_exists('id', $_GET)) {
    die("<p>Error: No book ID provided.</p>");
}
$id = $_GET['id'];

try {
    $book = Book::find($id);
    if ($book === null) {
        die("<p>Error: Book not found.</p>");
    }
    
    $publisher = Publisher::find($book->publisher_id);
    $formats = Format::findByBook($book->id);
    $formatNames = [];
    foreach ($formats as $f) {
        $formatNames[] = h($f->name);
    }
} 
catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>View Book: <?= h($book->title) ?></title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
        </div>
        <div class="container">
            <div class="width-12">
                <div class="hCard">
                    <div class="bottom-content">
                        <img src="uploads/<?= h($book->cover_filename) ?>" alt="Cover" />

                        <div class="actions">
                            <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a> /
                            <a href="book_delete.php?id=<?= h($book->id) ?>" onclick="return confirm('Delete?')">Delete</a> /
                            <a href="index.php">Back</a>
                        </div>
                    </div>

                    <div class="bottom-content">
                        <h2><?= h($book->title) ?></h2>
                        <p>Release Year: <?= h($book->year) ?></p>
                        <p>Author: <?= h($book->author) ?></p>
                        <p>ISBN: <?= h($book->isbn) ?></p>
                        <p>Publisher: <?= $publisher ? h($publisher->name) : 'Unknown' ?></p>
                        <p>Description:<br /><?= nl2br(h($book->description)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>