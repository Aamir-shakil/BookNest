<?php

class Admin extends Controller
{
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

    public function books()
    {
        $bookModel = $this->model('AdminBookModel');
        $books = $bookModel->getAllBooks();
        $this->view('admin/books', ['books' => $books]);
    }

    public function users()
    {
        $userModel = $this->model('AdminUserModel');
        $users = $userModel->getAllUsers();
        $this->view('admin/users', ['users' => $users]);
    }

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

