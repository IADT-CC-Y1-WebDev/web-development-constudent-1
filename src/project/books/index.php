<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/utils.php';
require_once 'php/classes/Book.php';
require_once 'php/classes/Publisher.php';

startSession();
$books = Book::findAll();
$publishers = Publisher::findAll();

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
    <div class="width-3">
        <a href="book_create.php" class="btn-main">Add New Book</a>
    </div>

    <div class="width-12 filters">
    <form id="filterForm" class="filter-bar">
        <span>Title: <input type="text" name="title" id="title_filter"></span>
        <span>Sort By: 
    <select name="sort_by" id="sort_filter">
    <option value="">-- Select Sort --</option>
    <option value="newest">Year (newest first)</option>
    <option value="oldest">Year (oldest first)</option>
    <option value="az">Title (A-Z)</option>
</select>
</span>
        <span>Publisher: 
            <select name="publisher_id" id="publisher_filter">
                <option value="">All Publishers</option>
                <?php foreach ($publishers as $pub): ?>
                    <option value="<?= $pub->id ?>"><?= htmlspecialchars($pub->name) ?></option>
                <?php endforeach; ?>
            </select>
        </span>
        <button type="button" id="applyBtn" class="btn-filter">Apply Filters</button>
        <button type="button" id="clearBtn" class="btn-link">Clear Filters</button>
    </form>
</div>

    <?php foreach ($books as $book): ?>
    <div class="width-3">
        <div class="book_card" 
             data-title="<?= htmlspecialchars($book->title) ?>" 
             data-year="<?= htmlspecialchars($book->year) ?>" 
             data-publisher="<?= htmlspecialchars($book->publisher_id) ?>">
            
            <h2><?= h($book->title) ?></h2>
            <p class="release-year"><?= h($book->year) ?></p>
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
<script type="module" src="js/books-filters.js"></script>
</body>
</html>