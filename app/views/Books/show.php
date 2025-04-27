<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>

    <div class="container">
        <h2><?= htmlspecialchars($data['book']['title']) ?></h2>
        <p>Author: <?= htmlspecialchars($data['book']['author']) ?></p>
        <p>Price: £<?= htmlspecialchars($data['book']['price']) ?></p>

        <?php if (isset($data['averageRating'])): ?>
            <p>Average Rating: <?= number_format($data['averageRating'], 1) ?>/5</p>
        <?php endif; ?>

        <h3>Reviews:</h3>
        <ul>
            <?php foreach ($data['reviews'] as $review): ?>
                <li>
                    <strong><?= htmlspecialchars($review['user_name']) ?>:</strong>
                    <?= htmlspecialchars($review['review_text']) ?>
                    -
                    <?php for ($i = 0; $i < (int) $review['rating']; $i++): ?>
                        ⭐
                    <?php endfor; ?>
                    (<?= $review['rating'] ?>/5)
                </li>
            <?php endforeach; ?>
        </ul>

        <?php if (isset($_SESSION['user_id'])): ?>
            <form method="POST" action="/reviews/add">
                <input type="hidden" name="book_id" value="<?= $data['book']['id'] ?>">
                <label for="review_text">Your Review:</label>
                <textarea id="review_text" name="review_text" placeholder="Leave a review..." required></textarea>

                <label for="rating">Rating:</label>
                <select id="rating" name="rating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button type="submit">Submit Review</button>
            </form>
        </div>
    <?php else: ?>
        <p><a href="/login">Log in</a> to leave a review!</p>
    <?php endif; ?>
</body>

</html>