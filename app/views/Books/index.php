<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNest Search Books</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <h1>Browse Books</h1>
    <!-- Display Cart Success Message -->
    <?php if (isset($_SESSION['cart_message'])): ?>
        <p  style="color: green; text-align: center; margin-top: 10px; font-size: 16px; font-weight: bold;"><?= $_SESSION['cart_message']; ?></p>
        <?php unset($_SESSION['cart_message']); // Clear message after showing ?>
    <?php endif; ?>
    <form method="GET" action="/books">
        <label for="query">Search:</label>
        <input type="text" id="query" name="query" placeholder="Search books..."
            value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>">
        <label id="filter" for="filter">Filter by:</label>
        <select id="filter" name="filter">
            <option value="">All</option>
            <option value="title" <?= (isset($_GET['filter']) && $_GET['filter'] === 'title') ? 'selected' : '' ?>>Title
            </option>
            <option value="author" <?= (isset($_GET['filter']) && $_GET['filter'] === 'author') ? 'selected' : '' ?>>Author
            </option>
        </select>
        <button type="submit">Search</button>
        <p>
            <a href="/Cart">My Cart</a> 
        </p>
    </form>
    <div class="book-list">
        <?php foreach ($data['books'] as $book): ?>
            <div class="book-item">
                <h2><?php echo htmlspecialchars($book['title']); ?></h2>
                <p>Author: <?php echo htmlspecialchars($book['author']); ?></p>
                <p>Price: £<?php echo htmlspecialchars($book['price']); ?></p>
                <a href="/books/addToCart/<?= $book['id'] ?>">Add to Cart</a> <!--Add to cart Button-->
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>