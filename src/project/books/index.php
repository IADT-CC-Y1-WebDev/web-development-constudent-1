<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/utils.php';
require_once 'php/classes/Book.php';

startSession();
$books = Book::findAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book</title>
    <?php require 'php/inc/head_content.php'; ?>
</head>
<body>

<div class="container">
    <?php require 'php/inc/flash_message.php'; ?>

    <div class="width-9">
        </div>
    <div class="width-3" style="display: flex; justify-content: flex-end; align-items: center;">
        <a href="book_create.php" class="btn-main">Add New Book</a>
    </div>

    <div class="width-12 filters">
        <form class="filter-bar" method="GET" action="index.php">
            <span>Title: <input type="text" name="title"></span>
            <span>Publisher: 
                <select name="publisher_id">
                    <option value="">All Publishers</option>
                </select>
            </span>
            <button type="submit" class="btn-filter">Apply Filters</button>
            <a href="index.php" class="btn-link">Clear Filters</a>
        </form>
    </div>

    <?php foreach ($books as $book): ?>
        <div class="width-3">
            <div class="book_card">
                <h2>Title: <?= h($book->title) ?></h2>
                <p class="release-year">Release Year: <?= h($book->year) ?></p>
                
                <div class="book-image">
                    <img src="uploads/<?= h($book->cover_filename) ?>" alt="Cover">
                </div>

                <div class="actions">
                    <a href="book_view.php?id=<?= $book->id ?>">VIEW</a> / 
                    <a href="book_edit.php?id=<?= $book->id ?>">EDIT</a> / 
                    <a href="book_delete.php?id=<?= $book->id ?>" onclick="return confirm('Delete?')">DELETE</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>