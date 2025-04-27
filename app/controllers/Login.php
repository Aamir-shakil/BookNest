<?php

class Login extends Controller
{

    public function index()
    {
        $this->view('auth/login');
    }

     /**
     * Authenticate the user.
     * 
     * Processes the login form submission:
     * - Validates user credentials.
     * - Sets session variables upon successful login.
     * - Redirects to dashboard if successful, or back to login with an error if failed.
     */
    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $userModel = $this->model('User');
            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['is_admin'] = $user['is_admin'];
                $userModel->setActiveStatus($user['id'], 1); // Set user as active
                header('Location: /dashboard'); // Redirect to the members area
                exit;
            } else {
                $this->view('auth/login', ['error' => 'Invalid email or password']);
            }
        }
    }
/**
     * Log out the user.
     * 
     * Clears the user's session and updates the user's active status*/
    public function logout()
    {
        if (isset($_SESSION['user_id'])) {
            $userModel = $this->model('User');
            $userModel->setActiveStatus($_SESSION['user_id'], 0);
        }
    
        session_destroy();
        header('Location: /login');
        exit;
    }
}
