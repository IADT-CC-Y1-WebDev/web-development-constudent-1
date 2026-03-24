<?php
require_once 'php/classes/Publisher.php';
require_once 'php/classes/Format.php';
require_once 'php/lib/config.php';
require_once 'php/lib/session.php'; 
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();
// dd($_SESSION);
try {
    $publishers = Publisher::findAll();
    $formats = Format::findAll();
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
        <title>Add New Book</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
            <div class="width-12">
                <h1>Add New Book</h1>
            </div>
            <div class="width-12">
                <form action="book_store.php" method="POST" enctype="multipart/form-data" novalidate>
                    
                    <div class="input">
                        <label class="special" for="title">Book Title:</label>
                        <div>
                            <input type="text" id="title" name="title" value="<?= old('title') ?>" required>
                            <p><?= error('title') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special" for="author">Author:</label>
                        <div>
                            <input type="text" id="author" name="author" value="<?= old('author') ?>" required>
                            <p><?= error('author') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special" for="publisher_id">Publisher:</label>
                        <div>
                            <select id="publisher_id" name="publisher_id" required>
                                <option value="">-- Select Publisher --</option>
                                <?php foreach ($publishers as $pub) { ?>
                                    <option value="<?= h($pub->id) ?>" <?= chosen('publisher_id', $pub->id) ? "selected" : "" ?>>
                                        <?= h($pub->name) ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <p><?= error('publisher_id') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special" for="year">Year:</label>
                        <div>
                            <input type="number" id="year" name="year" value="<?= old('year') ?>" required>
                            <p><?= error('year') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special" for="isbn">ISBN:</label>
                        <div>
                            <input type="text" id="isbn" name="isbn" value="<?= old('isbn') ?>" required>
                            <p><?= error('isbn') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special">Available Formats:</label>
                        <div class="checkbox-group">
                            <?php foreach ($formats as $format) { ?>
                                <div>
                                    <input type="checkbox" 
                                        id="format_<?= h($format->id) ?>" 
                                        name="format_ids[]" 
                                        value="<?= h($format->id) ?>"
                                        <?= chosen('format_ids', $format->id) ? "checked" : "" ?>
                                        >
                                    <label for="format_<?= h($format->id) ?>"><?= h($format->name) ?></label>
                                </div>
                            <?php } ?>
                        </div>
                        <p><?= error('format_ids') ?></p>
                    </div>

                    <div class="input">
                        <label class="special" for="description">Description:</label>
                        <div>
                            <textarea id="description" name="description" rows="5" required><?= old('description') ?></textarea>
                            <p><?= error('description') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label class="special" for="cover">Book Cover Image (max 2MB):</label>
                        <div>
                            <input type="file" id="cover" name="cover" accept="image/*" required>
                            <p><?= error('cover') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <button type="submit" class="button">Save Book</button>
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