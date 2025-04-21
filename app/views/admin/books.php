<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Books</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        /* Simple Modal Styling */
        #editBookModal {
            display: none;
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            background: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            z-index: 9999;
        }

        #editBookModal input {
            display: block;
            margin-bottom: 10px;
            width: 100%;
            padding: 5px;
        }

        #editBookModal button {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h1>📚 Books Management</h1>

    <?php
    // Safely get the $books variable
    $books = isset($data['books']) ? $data['books'] : [];
    ?>
    <div class="container">
        <form action="/admin/addBook" method="POST">
            <input name="title" placeholder="Title" required>
            <input name="author" placeholder="Author" required>
            <input name="price" placeholder="Price" type="number" step="0.01" required>
            <button type="submit">➕ Add Book</button>
        </form>
    </div>

    <h2>📖 Existing Books</h2>
    <?php if (isset($_SESSION['success_message'])): ?>
        <div
            style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
            <?= htmlspecialchars($_SESSION['success_message']) ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>


    <?php if (!empty($books)): ?>
        <ul>
            <?php foreach ($books as $book): ?>
                <li>
                    <strong><?= htmlspecialchars($book['title']) ?></strong>
                    by <?= htmlspecialchars($book['author']) ?> (£<?= number_format($book['price'], 2) ?>)
                    <br>
                    <a href="javascript:void(0);"
                        onclick="openEditModal('<?= $book['id'] ?>', '<?= htmlspecialchars($book['title']) ?>', '<?= htmlspecialchars($book['author']) ?>', '<?= $book['price'] ?>')">✏️
                        Edit</a>
                    |
                    <a href="/admin/deleteBook/<?= htmlspecialchars($book['id']) ?>"
                        onclick="return confirm('Are you sure you want to delete this book?')">❌ Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No books available yet.</p>
    <?php endif; ?>

    <!-- Edit Book Modal (Popup) -->
    <div id="editBookModal">
        <h2>Edit Book</h2>
        <form id="editBookForm" method="POST">
            <input type="text" name="title" id="edit-title" placeholder="Title" required>
            <input type="text" name="author" id="edit-author" placeholder="Author" required>
            <input type="number" step="0.01" name="price" id="edit-price" placeholder="Price" required>
            <button type="submit">💾 Save Changes</button>
            <button type="button" onclick="closeModal()">❌ Cancel</button>
        </form>
    </div>

    <script>
        function openEditModal(id, title, author, price) {
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-author').value = author;
            document.getElementById('edit-price').value = price;
            document.getElementById('editBookForm').action = '/admin/editBook/' + id;
            document.getElementById('editBookModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('editBookModal').style.display = 'none';
        }
    </script>

</body>

</html>