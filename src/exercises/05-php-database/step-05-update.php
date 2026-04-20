<?php
require_once __DIR__ . '/lib/config.php';
// =============================================================================
// Create PDO connection
// =============================================================================
try {
    $db = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
} 
catch (PDOException $e) {
    echo "<p class='error'>Connection failed: " . $e->getMessage() . "</p>";
    exit();
}
// =============================================================================
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/inc/head_content.php'; ?>
    <title>Exercise 5: UPDATE Operations - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-05-update.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 5: UPDATE Operations</h1>

        <h2>Task</h2>
        <p>Update an existing book's description.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>First, display the current details of book ID 1</li>
            <li>Update the description to include a timestamp</li>
            <li>Check <code>rowCount()</code> to verify the update worked</li>
            <li>Display the updated book details</li>
        </ol>

        <h3>Your Solution:</h3>
        <div class="output">
            <?php
            // TODO: Write your solution here
           // 1. Fetch and display book ID 1
            $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
            $stmt->execute(['id' => 1]);
            $book = $stmt->fetch();
            echo "Current Book: " . htmlspecialchars($book['title']);

            function updateBook($db, $id, $title, $author, $year, $publisherId, $description) {
                // 2. Prepare: UPDATE books
                $stmt = $db->prepare("
                    UPDATE books
                    SET title = :title,
                        author = :author,
                        year = :year,
                        publisher_id = :publisher_id,
                        description = :description
                    WHERE id = :id
                ");
                
                // 3. Execute with data
                $params = [
                    'title'        => $title,
                    'author'       => $author,
                    'year'         => $year,
                    'publisher_id' => $publisherId,
                    'description'  => $description,
                    'id'           => $id
                ];
                $status = $stmt->execute($params);

                if (!$status) {
                    $error_info = $stmt->errorInfo();
                    throw new Exception("Update failed: " . $error_info[2]);
                }

                // 4. Check rowCount()
                if ($stmt->rowCount() === 0) {
                    throw new Exception("No book found with ID: $id");
                }

                return true;
            }

            $newDescription = $book['description'] . " (Updated: " . date('H:i:s') . ")";
            updateBook($db, 1, $book['title'], $book['author'], $book['year'], $book['publisher_id'], $newDescription);

            // 5. Fetch and display updated book
            $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
            $stmt->execute(['id' => 1]);
            $updatedBook = $stmt->fetch();
            echo "<p>Updated successfully</p>";
            echo "New Description: " . htmlspecialchars($updatedBook['description']);

            ?>
        </div>
    </div>
</body>
</html>
