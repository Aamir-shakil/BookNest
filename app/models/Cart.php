<?php
session_start();
class Cart extends Model {
      // Add book to cart
      public function addToCart($userId, $bookId) {
        // Check if the book is already in the cart
        $stmt = $this->db->prepare("SELECT * FROM cart WHERE user_id = ? AND book_id = ?");
        $stmt->execute([$userId, $bookId]);
        $cartItem = $stmt->fetch();

        if ($cartItem) {
            // If the book is already in the cart, update the quantity
            $stmt = $this->db->prepare("UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND book_id = ?");
            $stmt->execute([$userId, $bookId]);
        } else {
            // Otherwise, insert new entry
            $stmt = $this->db->prepare("INSERT INTO cart (user_id, book_id, quantity) VALUES (?, ?, 1)");
            $stmt->execute([$userId, $bookId]);
        }
    }
}


