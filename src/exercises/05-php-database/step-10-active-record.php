    <?php
    require_once __DIR__ . '/lib/config.php';
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 10: Complete Active Record - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-10-active-record.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 10: Complete Active Record Pattern</h1>

        <h2>Task</h2>
        <p>Implement the <code>save()</code> and <code>delete()</code> methods in the Book class.</p>

        <h3>Methods to Implement:</h3>
        <ol>
            <li><code>save()</code> - INSERT if new (no id), UPDATE if existing (has id)</li>
            <li><code>delete()</code> - DELETE the record from the database</li>
        </ol>

        <h3>Test CREATE (new book):</h3>
<div class="output">
    <?php
        $book = new Book();
        $book->title = "Test Book " . time();
        $book->author = "Test Author";
        $book->isbn = 123456789;
        $book->year = 2024;
        $book->description = "book description";

        if (method_exists($book, 'save')) {
            $book->save();
            $createdId = $book->id;
            echo "Created book with ID: " . ($createdId ? $createdId : "FAILED - No ID generated");
        } else {
            echo "Error: save() method does not exist in Book class.";
        }
    ?>
</div>

<h3>Test UPDATE:</h3>
<div class="output">
    <?php
        if (isset($createdId) && $createdId) {
            $book = Book::findById($createdId);
            
            if ($book !== null) {
                $book->title = "Updated Title " . time();
                $book->save();
                echo "Updated title to: " . $book->title;
            } else {
                echo "Error: Book with ID $createdId was not found in the database. Check if save() actually inserted data.";
            }
        } else {
            echo "Error: \$createdId is missing or invalid.";
        }
    ?>
</div>

        <h3>Test DELETE:</h3>
        <div class="output">
            <?php
                $book = Book::findById($createdId);
                
                if ($book) {
                    $book->delete();
                    echo "Book deleted.<br>";
                }
                
                $check = Book::findById($createdId);
                if ($check === null) {
                    echo "<p class='success'>Correctly deleted from database.</p>";
                } else {
                    echo "<p class='warning'>Delete failed: Book still exists.</p>";
                }
            ?>
        </div>

        <h2>Congratulations!</h2>
        <p>If all tests pass, you have successfully implemented the Active Record pattern for the Book class!</p>

        <h3>Your Book class should now support:</h3>
        <ul>
            <li><code>Book::findAll()</code> - Get all books</li>
            <li><code>Book::findById($id)</code> - Get one book</li>
            <li><code>Book::findByPublisher($id)</code> - Get books by publisher</li>
            <li><code>$book->save()</code> - Create or update</li>
            <li><code>$book->delete()</code> - Remove from database</li>
            <li><code>$book->toArray()</code> - Convert to array</li>
        </ul>
    </div>
</body>
</html>
