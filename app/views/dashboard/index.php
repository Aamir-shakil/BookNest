<!DOCTYPE html>
<html lang="en">
<!-- dashboard For users and Admin-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($data['user']) ?>!</h1>
        <p>You are now logged in.</p>
        <a href="/login/logout">Logout</a>
        <p><a href="/books">Browse Books</a></p>
        <p><a href="/admin">Administrator Panel</a></p>
    </div>
</body>

</html>