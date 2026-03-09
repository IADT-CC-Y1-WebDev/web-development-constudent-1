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
            function updateGame($db, $id, $title, $author, $year, $publisherId, $description) {
            // 2. Prepare: UPDATE books SET description = :description WHERE id = :id
            $stmt = $db->prepare("
                UPDATE books
                SET title = :title,
                    author = :author,
                    year = :year,
                    publisher_id = :publisher_id,
                    description = :description
                WHERE id = :id
            ");
            
             // 3. Execute with new description + timestamp
            $params = [
            'title' => $title,
            'year' => $year,
            'publisher_id' => $publisherId,
            'description' => $description,
            'id' => $id
            ];
                $status = $stmt->execute($params);

            // 4. Check rowCount()
            if ($stmt->rowCount() === 0) {
            throw new Exception("No game found with ID: $id");
            }
            // 5. Fetch and display updated book
            
            }

            ?>
        </div>
    </div>
</body>
</html>
