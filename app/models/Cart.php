<?php
session_start();
class Cart {
    public function addToCart($bookId, $title, $price) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        if (!isset($_SESSION['cart'][$bookId])) {
            $_SESSION['cart'][$bookId] = [
                'title' => $title,
                'price' => $price,
                'quantity' => 1
            ];
        } else {
            $_SESSION['cart'][$bookId]['quantity'] += 1;
        }
    }
}


