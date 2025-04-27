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

        // Debugging: Log the user ID
        error_log("User ID: " . $userId);

        // Load the Cart model
        $cartModel = $this->model('CartModel');

        // Fetch cart items from the model
        $cartItems = $cartModel->getUserCart($userId);

        // Debugging: Log the cart items
        error_log("Cart Items: " . print_r($cartItems, true));

        // Pass cart items to the view
        $this->view('cart/index', ['cartItems' => $cartItems]);
    }
    public function checkout()
{
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
     // Load the Cart model
     $cartModel = $this->model('CartModel');

     // Clear the user's cart
     $cartModel->checkout($userId);

    $this->view('cart/checkout');
}
}