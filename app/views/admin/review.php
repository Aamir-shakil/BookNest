<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Manage Reviews</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <h1>Manage Reviews</h1>

    <?php if (isset($_SESSION['review_message'])): ?>
        <p style="color: green;"><?= $_SESSION['review_message']; ?></p>
        <?php unset($_SESSION['review_message']); ?>
    <?php endif; ?>
    <div class="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>User</th>
                    <th>Review Text</th>
                    <th>Rating</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['reviews'] as $review): ?>
                    <tr>
                        <td><?= htmlspecialchars($review['book_title']) ?></td>
                        <td><?= htmlspecialchars($review['user_name']) ?></td>
                        <td><?= htmlspecialchars($review['review_text']) ?></td>
                        <td><?= htmlspecialchars($review['rating']) ?>/5</td>
                        <td><?= htmlspecialchars($review['created_at']) ?></td>
                        <td>
                            <a href="/adminreview/delete/<?= $review['id'] ?>"
                                onclick="return confirm('Are you sure you want to delete this review?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><a href="/admin">← Back to Dashboard</a></p>
    </div>
</body>

</html>