<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <?php if (empty($data['cartItems'])): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($data['cartItems'] as $item): ?>
                <li>
                    <?= htmlspecialchars($item['title']) ?> - $<?= htmlspecialchars($item['price']) ?> 
                    (Quantity: <?= htmlspecialchars($item['quantity']) ?>)
                    <a href="/books/removeFromCart/<?= $item['id'] ?>">Remove</a>
                </li>
            <?php endforeach; ?>
        </ul>
        <a href="/books/checkout">Proceed to Checkout</a>
    <?php endif; ?>
</body>
</html>