<!DOCTYPE html>
<html lang="en">
<!-- Homepage for the Bookstore Application -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        <h1>Welcome to the <?= $data['title'] ?> Page!</h1>
        <p>
            <a href="/register">Register</a> |
            <a href="/login">Login</a>
        </p>
    </div>
</body>
</html>