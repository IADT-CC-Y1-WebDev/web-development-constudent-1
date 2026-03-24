<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/utils.php';
require_once 'php/classes/DB.php'; 
require_once 'php/classes/Book.php';
require_once 'php/classes/Format.php'; 

startSession();

$id = $_GET['id'] ?? null;
$book = Book::find($id); 


if (!$book) {
    header('Location: index.php');
    exit;
}

$formats = Format::findByBook($book->id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View: <?= h($book->title) ?></title>
    <?php require 'php/inc/head_content.php'; ?>
</head>
<body>

<div class="container">
    <?php require 'php/inc/flash_message.php'; ?>

    <div class="view-card">
        <div class="view-sidebar">
            <div class="view-image">
                <img src="uploads/<?= h($book->cover_filename) ?>" alt="Cover Image">
            </div>
            
            <div class="view-actions">
                <a href="book_edit.php?id=<?= $book->id ?>" class="link-edit">EDIT</a>
                <span class="separator">/</span>
                <a href="book_delete.php?id=<?= $book->id ?>" class="link-delete" onclick="return confirm('Delete this book?')">DELETE</a>
                <span class="separator">/</span>
                <a href="index.php" class="link-back">BACK</a>
            </div>
        </div>

        <div class="view-details">
            <h1>Title: <?= h($book->title) ?></h1>
            <p class="detail-item"><strong>Author:</strong> <?= h($book->author) ?></p>
            <p class="detail-item"><strong>Release Year:</strong> <?= h($book->year) ?></p>
            <p class="detail-item"><strong>ISBN:</strong> <?= h($book->isbn) ?></p>
            
            <p class="detail-item"><strong>Available Formats:</strong> 
                <span class="format-list">
                    <?php 
                    if (!empty($formats)) {
                        $names = array_map(fn($f) => $f->name, $formats);
                        echo h(implode(', ', $names)); 
                    } else {
                        echo "None specified";
                    }
                    ?>
                </span>
            </p>

            <div class="detail-description">
                <strong>Description:</strong>
                <p><?= nl2br(h($book->description)) ?></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>