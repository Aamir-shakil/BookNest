<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        <h1>Checkout</h1>
        <p>
            <?= isset($data['message']) ? htmlspecialchars($data['message']) : 'Thank you for your purchase!' ?>
        </p>
        <a href="/books">Continue Shopping</a>
    </div>
</body>

</html>