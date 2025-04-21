<?php

class Books extends Controller
{
    public function index()
    {
        $bookModel = $this->model('Book'); // Load the Book model
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';
        $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

        if (!empty($query)) {
            $books = $bookModel->searchBooks($query, $filter);
        } else {
            $books = []; // Empty array when no search is performed
        }

        $this->view('books/index', ['books' => $books]);
    }

    public function addToCart($bookId)
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login"); // Redirect to login if not logged in
            exit;
        }
        $userId = $_SESSION['user_id'];

        // Use CartModel instead of Cart controller
        $cartModel = $this->model('CartModel');
        $cartModel->addToCart($userId, $bookId);

        $_SESSION['cart_message'] = "Book added to cart successfully!";
        header("Location: /books");
        exit;
    }

    public function viewCart()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }
        $userId = $_SESSION['user_id'];

        // Use CartModel to fetch cart items
        $cartModel = $this->model('CartModel');
        $data['cartItems'] = $cartModel->getUserCart($userId);

        $this->view('cart/index', $data);
    }

    public function checkout()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }
        $userId = $_SESSION['user_id'];

        // Use CartModel for checkout
        $cartModel = $this->model('CartModel');
        $message = $cartModel->checkout($userId);

        $data['message'] = $message;
        $this->view('cart/checkout', $data);
    }
    public function show($id)
    {
        $bookModel = $this->model('Book');
        $reviewModel = $this->model('Review');

        $book = $bookModel->getBookById($id); // NOT calling view()
        $reviews = $reviewModel->getReviewsByBook($id);
        $averageRating = $reviewModel->getAverageRating($id);

        $this->view('books/show', [
            'book' => $book,
            'reviews' => $reviews,
            'averageRating' => $averageRating
        ]);
    }
}
?>