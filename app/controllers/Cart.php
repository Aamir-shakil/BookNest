<?php

class Cart extends Controller
{
    public function index()
    {
        // Ensure the user is logged in
        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        if (!$userId) {
            $_SESSION['cart_message'] = 'You need to log in to view your cart.';
            header('Location: /login');
            exit;
        }

        // Fetch cart items from the database using the inherited $db property
        $cartItems = $this->db->prepare("SELECT * FROM cart WHERE user_id = ?");
        $cartItems->execute([$userId]);
        $cartItems = $cartItems->fetchAll();

        // Pass cart items to the view
        $this->view('cart/index', ['cartItems' => $cartItems]);
    }
}