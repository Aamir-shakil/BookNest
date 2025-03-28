<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNest Search Books</title>
</head>

<body>
    <h1>Browse Books</h1>
    <form method="GET" action="/books">
        <input type="text" name="query" placeholder="Search books..."
            value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>">
        <select name="filter">
            <option value="">All</option>
            <option value="title" <?= (isset($_GET['filter']) && $_GET['filter'] === 'title') ? 'selected' : '' ?>>Title
            </option>
            <option value="author" <?= (isset($_GET['filter']) && $_GET['filter'] === 'author') ? 'selected' : '' ?>>Author
            </option>
        </select>
        <button type="submit">Search</button>
    </form>
    <div class="book-list">
        <?php foreach ($data['books'] as $book): ?>
            <div class="book-item">
                <h2><?php echo htmlspecialchars($book['title']); ?></h2>
                <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
                <p>Price: $<?php echo htmlspecialchars($book['price']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>



</body>

</html>