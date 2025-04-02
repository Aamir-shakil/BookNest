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
}

// This controller is responsible for handling the request to display all books. It calls the getAllBooks() method from the Book model to retrieve all books from the database and passes them to the view for rendering. The view file will then display the list of books to the user.

?>