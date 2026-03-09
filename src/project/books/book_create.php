<?php
require_once 'php/lib/config.php';
require_once 'php/inc/formatters.php';
require_once 'php/classes/Book.php';
require_once 'php/inc/utilities.php';

$host = 'mysql-container';
$dbname = 'testdb';
$username = 'testuser';
$password = 'mysecret';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {

    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New Book</title>
</head>
<body>

    <h1>Add New Book</h1>


    <form action="book_store.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="title">Book Title:</label>

            <input type="text" id="title" name="title" value="<?= old('title') ?>">

                <?php if (error('title')): ?>
                    <p class="error"><?= error('title') ?></p>
                <?php endif; ?>

        </div>

        <div class="form-group">
            <label for="author">Author:</label>

            <input type="text" id="author" name="author" value="">

            <?php if (error('author')): ?>
                <p class="error"><?= error('author') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="publisher_id">Publisher:</label>
            <select id="publisher_id" name="publisher_id">
                <option value="">-- Select Publisher --</option>

                <?php foreach ($publishers as $pub): ?>
                    <option value="<?= $pub['id'] ?>">
                        <?= h($pub['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <?php if (error('publisher')): ?>
                <p class="error"><?= error('publisher') ?></p>
            <?php endif; ?>

        </div>

        <div class="form-group">
            <label for="year">Year:</label>
            <input type="text" id="year" name="year" value="">

                  <?php if (error('year')): ?>
                <p class="error"><?= error('year') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" value="">

                <?php if (error('isbn')): ?>
                <p class="error"><?= error('isbn') ?></p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Available Formats:</label>
            <div class="checkbox-group">

                <?php foreach ($formats as $format): ?>
                    <label class="checkbox-label">
                        <input type="checkbox" name="format_ids[]" value="<?= $format['id'] ?>">
                        <?= h($format['name']) ?>
                    </label>
                <?php endforeach; ?>
            </div>

                    <?php if (error('checkbox-label')): ?>
                <p class="error"><?= error('checkbox-label') ?></p>
            <?php endif; ?>
        </div>


        <div class="form-group">
            <label for="description">Description:</label>                       
            <textarea id="description" name="description" rows="5"></textarea>


                      <?php if (error('description')): ?>
                <p class="error"><?= error('description') ?></p>
            <?php endif; ?>  
        </div>

        <div class="form-group">
            <label for="cover">Book Cover Image (max 2MB):</label>

            <input type="file" id="cover" name="cover" accept="image/*">

                         <?php if (error('cover')): ?>
                <p class="error"><?= error('cover') ?></p>
            <?php endif; ?>  
        </div>
        <div class="form-group">
            <button type="submit" class="button">Save Book</button>
        </div>
    </form>
    <?php
    ?>
    </body>
</html>