<?php
require_once 'php/lib/config.php';
require_once 'php/classes/Book.php';

startSession();


try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('No Book ID provided.');
    }
    $id = $_GET['id'];

    $Book = Book::findById($id);
    if ($Book === null) {
        throw new Exception("Book not found.");
    }

    $BookPlatforms = Platform::findByBook($Book->id);
    $BookPlatformsIds = [];
    foreach ($BookPlatforms as $platform) {
        $BookPlatformsIds[] = $platform->id;
    }

    $authors = author::findAll();
    $platforms = Platform::findAll();
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
        <title>Edit Book</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
            <div class="width-12">
                <h1>Edit Book</h1>
            </div>
            <div class="width-12">
                <form action="Book_update.php" method="POST" enctype="multipart/form-data">
                    <div class="input">
                        <input type="hidden" name="id" value="<?= h($Book->id) ?>">
                    </div>
                    <div class="input">
                        <label class="special" for="title">Title:</label>
                        <div>
                            <input type="text" id="title" name="title" value="<?= old('title', $Book->title) ?>" required>
                            <p><?= error('title') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="published_year">Release Year:</label>
                        <div>
                            <input type="date" id="published_year" name="published_year" value="<?= old('published_year', $Book->published_year) ?>" required>
                            <p><?= error('published_year') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="author_id">author:</label>
                        <div>
                            <select id="author_id" name="author_id" required>
                                <?php foreach ($authors as $author) { ?>
                                    <option value="<?= h($author->id) ?>" <?= chosen('author_id', $author->id, $Book->author_id) ? "selected" : "" ?>>
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
                            <textarea id="description" name="description" required><?= old('description', $Book->description) ?></textarea>
                            <p><?= error('description') ?></p>
                        </div>
                    </div>
                    <div><img src="images/<?= $Book->image_filename ?>" /></div>
                    <div class="input">
                        <label class="special" for="image">Image (optional):</label>
                        <div>
                            <input type="file" id="image" name="image" accept="image/*">
                            <p><?= error('image') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <button class="button" type="submit">Update Book</button>
                        <div class="button"><a href="index.php">Cancel</a></div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
clearFormData();
clearFormErrors();
?>