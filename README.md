# 📚 BookNest – Online Bookstore

BookNest is a database-driven e-commerce web application built for a small independent bookstore. It allows customers to browse and search for books, register an account, leave reviews, add items to a cart, and place orders. Administrators can manage books, users, and reviews through a secure admin panel.

## 🌐 Live Features

- ✅ User registration and login (secure authentication)
- 🔍 Book browsing and search (by title and author)
- 🛒 Shopping cart and checkout
- ✍️ User reviews with star ratings
- 🧑‍💼 Admin panel to manage books, users, and reviews
- ♿ Accessibility features (WCAG 2.1 friendly)
- 🔐 Secure development practices (XSS protection, prepared statements)

## Making a user an admin
- Log into your MySQL database.
- Find the user's record in the users table.
- Set the is_admin field to 1 for that user.
- UPDATE users SET is_admin = 1 WHERE email = 'user@example.com';
- The above code will will grant access to the /admin panel on next login.
