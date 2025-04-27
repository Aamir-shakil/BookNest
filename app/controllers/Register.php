<?php

class Register extends Controller
{
    public function index()
    {
        $this->view('auth/register');
    }
    /*
     * Process and store a new user registration.
     * 
     * - Validates user input fields.
     * - Ensures passwords match.
     * - Attempts to register the user using the User model.
     * - Redirects to login on success, or reloads the registration page with an error on failure.
     */
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $confirmPassword = trim($_POST['confirm_password']);

            // Basic validation
            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                $this->view('auth/register', ['error' => 'All fields are required']);
                return;
            }

            if ($password !== $confirmPassword) {
                $this->view('auth/register', ['error' => 'Passwords do not match']);
                return;
            }

            $userModel = $this->model('User');

            if ($userModel->register($name, $email, $password)) {
                header('Location: /login');
                exit;
            } else {
                $this->view('auth/register', ['error' => 'Email already in use']);
            }
        }
    }
}
