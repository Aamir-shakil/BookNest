<?php
$cartItems = $data['cartItems']; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        <h1>My Cart</h1>

        <?php if (!empty($cartItems)): ?>
            <ul>
                <?php foreach ($cartItems as $item): ?>
                    <li>
                        <strong><?= htmlspecialchars($item['book_title']) ?></strong> - 
                        <?= htmlspecialchars($item['quantity']) ?> x 
                        $<?= htmlspecialchars($item['price']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>

        <a href="/books">Continue Shopping</a>
        <a href="/cart/checkout">Proceed to Checkout</a>
    </div>
</body>

</html>