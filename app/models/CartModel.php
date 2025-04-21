<?php
class CartModel extends Model {
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
     // Get the user's cart items
     public function getUserCart($userId) {
        $stmt = $this->db->prepare("
            SELECT cart.book_id, books.title AS book_title, books.price, cart.quantity 
            FROM cart 
            JOIN books ON cart.book_id = books.id 
            WHERE cart.user_id = ?
        ");
        $stmt->execute([$userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Debugging: Log the result
        error_log(print_r($result, true));

        return $result;
    }

    // Remove book from cart
    public function removeFromCart($userId, $bookId) {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE user_id = ? AND book_id = ?");
        $stmt->execute([$userId, $bookId]);
    }

    // Checkout: Clear cart after purchase
    public function checkout($userId) {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->execute([$userId]);
        return "Checkout complete! Thank you for your purchase.";
    }
}
?>



