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
    <title>Exercise 6: DELETE Operations - PHP Database</title>
</head>
<body>
    <div class="container">
        <div class="back-link">
            <a href="index.php">&larr; Back to Database Access</a>
            <a href="/examples/05-php-database/step-06-delete.php">View Example &rarr;</a>
        </div>

        <h1>Exercise 6: DELETE Operations</h1>

        <h2>Task</h2>
        <p>Create a temporary book and then delete it.</p>

        <h3>Requirements:</h3>
        <ol>
            <li>Insert a new temporary book</li>
            <li>Display the book's ID</li>
            <li>Delete the book using a prepared statement</li>
            <li>Verify the deletion by trying to fetch it again</li>
        </ol>

        <h3>Your Solution:</h3>
        <div class="output">
            <?php
// 1. Define the delete function
    function deleteBook($db, $id) {
        $stmt = $db->prepare("DELETE FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);
    return $stmt->rowCount();
}

// 2. Execute the deletion (Use a real ID, e.g., 15)
    try {
        $idToDelete = 15;
        $deleted = deleteBook($db, $idToDelete);

    // 3. Check the result and display message
    if ($deleted > 0) {
        echo "Deleted $deleted record(s).";
    } else {
        echo "No records found to delete with ID: " . htmlspecialchars($idToDelete);
    }
    } catch (Exception $e) {
        echo "Cannot delete: " . htmlspecialchars($e->getMessage());
    }

            ?>
        </div>
    </div>
</body>
</html>
