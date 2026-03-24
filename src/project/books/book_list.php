<?php
require_once 'php/lib/config.php';
require_once 'php/classes/Book.php';


try {
    $books = Book::findAll();
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book List</title>
    <?php require 'php/inc/head_content.php'; ?>
</head>
<body>

<div class="container">

    <h1>Book List</h1>

    <p>
        <a class="button" href="book_create.php">Create New Book</a>
    </p>

    <?php if (empty($books)) { ?>
        <p>No books found.</p>
    <?php } else { ?>

        <table class="book_table">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Published Year</th>
                <th>Actions</th>
            </tr>

            <?php foreach ($books as $book) { ?>
                <tr>
                    <td><?php echo $book->id; ?></td>
                    <td><?php echo htmlspecialchars($book->title); ?></td>
                    <td><?php echo $book->published_year; ?></td>
                    <td>
                        <a href="book_view.php?id=<?php echo $book->id; ?>">View</a> |
                        <a href="book_edit.php?id=<?php echo $book->id; ?>">Edit</a> |
                        <a href="book_delete.php?id=<?php echo $book->id; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>

        </table>

    <?php } ?>

</div>

</body>
</html>