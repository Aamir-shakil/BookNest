<?php
/**
 * Dashboard Controller
 * 
 * Handles the main user dashboard functionality.
 * */
class Dashboard extends Controller
{
    //checks if user is logged in and loads the dashboard view.
    public function index()
    {
        if (!isset($_SESSION['user_name'])) {
            header('Location: /login');
            exit;
        }

        $this->view('dashboard/index', ['user' => $_SESSION['user_name']]);
    }
}
