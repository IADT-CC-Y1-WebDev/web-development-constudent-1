<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !array_key_exists('id', $_GET)) {
    die("<p>Error: No Book ID provided.</p>");
}
$id = $_GET['id'];

try {
    $Book = Book::findById($id);
    if ($Book === null) {
        die("<p>Error: Book not found.</p>");
    }

    $Author = Author::findById($Book->Author_id);
    $platforms = Platform::findByBook($Book->id);

    $platformNames = [];
    foreach ($platforms as $platform) {
        $platformNames[] = htmlspecialchars($platform->name);
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
        <title>View Book</title>
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
                        <img src="images/<?= htmlspecialchars($Book->image_filename) ?>" />

                        <div class="actions">
                            <a href="Book_edit.php?id=<?= h($Book->id) ?>">Edit</a> /
                            <a href="Book_delete.php?id=<?= h($Book->id) ?>">Delete</a> /
                            <a href="index.php">Back</a>
                        </div>
                    </div>

                    <div class="bottom-content">
                        <h2><?= htmlspecialchars($Book->title) ?></h2>
                        <p>Release Year: <?= htmlspecialchars($Book->published_year) ?></p>
                        <p>Author: <?= htmlspecialchars($Author->name) ?></p>
                        <p>Description:<br /><?= nl2br(htmlspecialchars($Book->description)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>