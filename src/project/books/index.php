<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Book List</h1>
    <p>
        <a class="button" href="book_list.php">View All Books</a>
    </p>
</div>

<div class="container">
    <h1>Books</h1>
    <p>
        <a class="button" href="book_create.php">Add New Book</a>
    </p>

    <?php if (empty($books)) { ?>
        <p>No books found.</p>
    <?php } else { ?>

        <?php foreach ($books as $book) { ?>
            <div class="book_card">
                <h3><?php echo h($book->title); ?></h3>
                <p>Published Year: <?php echo h($book->published_year); ?></p>

                <div class="actions">
                    <a href="book_view.php?id=<?php echo $book->id; ?>">View</a>
                    <a href="book_edit.php?id=<?php echo $book->id; ?>">Edit</a>
                    <a href="book_delete.php?id=<?php echo $book->id; ?>">Delete</a>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>

</body>
</html>