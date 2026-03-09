<?php
require_once 'php/lib/config.php';
require_once 'php/classes/Book.php';


try {
    $books = Book::findAll();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
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
            <div class="width-12">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
            <div class="width-12">
                <h1>Create Book</h1>
            </div>
            <div class="width-12">
                <form action="Book_store.php" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="input">
                        <label class="special" for="title">Title:</label>
                        <div>
                            <input type="text" id="title" name="title" value="<?= old('title') ?>" required>
                            <p><?= error('title') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="published_year">Year:</label>
                        <div>
                            <input type="Year" id="Year" name="Year" value="<?= old('Year') ?>" required>
                            <p><?= error('Year') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="author_id">Author:</label>
                        <div>
                            <select id="author_id" name="author_id" required>
                                <?php foreach ($author as $author) { ?>
                                    <option value="<?= h($author->id) ?>" <?= chosen('author_id', $author->id) ? "selected" : "" ?>>
                                        <?= h($author->name) ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <p><?= error('author_id') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="description">Description:</label>
                        <div>
                            <textarea id="description" name="description" required><?= old('description') ?></textarea>
                            <p><?= error('description') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="image">Image (required):</label>
                        <div>
                            <input type="file" id="image" name="image" accept="image/*" required>
                            <p><?= error('image') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <button  class="button" type="submit">Store Book</button>
                        <div class="button"><a href="index.php">Cancel</a></div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>