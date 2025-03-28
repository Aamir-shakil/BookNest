<?php
class Books extends Controller
{

    public function index()
    {
        require_once '../app/models/Book.php';
        $bookModel = new Book();

        // Get search parameters
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';
        $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

        // Fetch books based on search query
        $books = $bookModel->searchBooks($query, $filter);

        require_once '../app/views/books/index.php';
    }
}

// This controller is responsible for handling the request to display all books. It calls the getAllBooks() method from the Book model to retrieve all books from the database and passes them to the view for rendering. The view file will then display the list of books to the user.

?>