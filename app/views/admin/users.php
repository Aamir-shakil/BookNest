<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <h1>👤 Manage Users</h1>

    <?php
    // Safely get users data
    $users = isset($data['users']) ? $data['users'] : [];
    ?>

    <?php if (!empty($users)): ?>
        <ul class="user-list">
            <?php foreach ($users as $user): ?>
                <li class="user-item">
                    <strong><?= htmlspecialchars($user['name']) ?></strong> (<?= htmlspecialchars($user['email']) ?>)
                    <br>
                    Status: <?= $user['is_active'] ? '✅ Active' : '❌ Inactive' ?>
                    <br>
                    <a href="/admin/deactivateUser/<?= htmlspecialchars($user['id']) ?>" class="btn deactivate-btn">
                        Deactivate
                    </a>
                    |
                    <a href="/admin/deleteUser/<?= htmlspecialchars($user['id']) ?>"
                       onclick="return confirm('Are you sure you want to delete this user?')"
                       class="btn delete-btn">
                        Delete
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>

</body>

</html>
