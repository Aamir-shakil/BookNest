<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNest Search Books</title>
</head>
<body>
<h1>Browse Books</h1>
    <div class="book-list">
        <?php foreach ($data['books'] as $book): ?>
            <div class="book-item">
                <h2><?php echo htmlspecialchars($book['title']); ?></h2>
                <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
                <p>Price: $<?php echo htmlspecialchars($book['price']); ?></p>
                <a href="book.php?id=<?php echo $book['id']; ?>">View Details</a>
            </div>
        <?php endforeach; ?>
    </div>
    
</body>
</html>