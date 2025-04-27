<?php
/**
 * Admin Controller
 * 
 * Handles all admin-related actions such as managing books, users, and displaying the dashboard.
 * Access is restricted to users with admin privileges.
 */
class Admin extends Controller
{
    /**
     * Constructor
     * 
     * Ensures that only users with admin privileges can access admin pages.
     */
    public function __construct()
    {
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== 1) {
            $_SESSION['error_message'] = '❌ You are not authorized to access the admin area.';
            header('Location: /login');
            exit;
        }
    }
    public function index()
{
    $this->dashboard();
}
    //Loads all books and passes them to the view.
    public function books()
    {
        $bookModel = $this->model('AdminBookModel');
        $books = $bookModel->getAllBooks();
        $this->view('admin/books', ['books' => $books]);
    }
    //Loads all users and passes them to the view
    public function users()
    {
        $userModel = $this->model('AdminUserModel');
        $users = $userModel->getAllUsers();
        $this->view('admin/users', ['users' => $users]);
    }
    //Processes POST request to add a new book via AdminBookModel.
    public function addBook()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookModel = $this->model('AdminBookModel');
            $bookModel->addBook($_POST);
            $_SESSION['success_message'] = '✅ Book added successfully!';
            header('Location: /admin/books');
            exit;
        }
    }
    //dashboard page.
    public function dashboard()
{
    $this->view('admin/AdminDashboard');
}

    public function editBook($id)
    {
        $bookModel = $this->model('AdminBookModel');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookModel->updateBook($id, $_POST);
            header('Location: /admin/books');
            exit;
        }
    }
    //Delete a book function
    public function deleteBook($id)
    {
        $bookModel = $this->model('AdminBookModel');
        $bookModel->deleteBook($id);
        header('Location: /admin/books');
        exit;
    }

    public function deactivateUser($id)
    {
        $userModel = $this->model('AdminUserModel');
        $userModel->deactivateUser($id);
        header('Location: /admin/users');
        exit;
    }

    public function deleteUser($id)
    {
        $userModel = $this->model('AdminUserModel');
        $userModel->deleteUser($id);
        header('Location: /admin/users');
        exit;
    }
}
?>

