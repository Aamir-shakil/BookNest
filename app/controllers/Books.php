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
    public function addToCart($bookId) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login"); // Redirect to login if not logged in
            exit;
        }
        $userId = $_SESSION['user_id'];

        $cart = new Cart();
        $cart->addToCart($userId, $bookId);

        header("Location: /books");
        exit;
    }

    public function viewCart() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }
        $userId = $_SESSION['user_id'];

        $cart = new Cart();
        $data['cartItems'] = $cart->getUserCart($userId);
        $this->view('cart/index', $data);
    }

    public function checkout() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }
        $userId = $_SESSION['user_id'];

        $cart = new Cart();
        $message = $cart->checkout($userId);
        
        $data['message'] = $message;
        $this->view('cart/checkout', $data);
    }
}


// This controller is responsible for handling the request to display all books. It calls the getAllBooks() method from the Book model to retrieve all books from the database and passes them to the view for rendering. The view file will then display the list of books to the user.

?>