<?php
/**
 * Base Controller class
 * 
 * Provides methods to load models and views.
 * All application controllers should extend this class.
 */
class Controller
{
    // Load a model
    protected function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    // Load a view
    protected function view($view, $data = [])
    {
        $viewPath = '../app/views/' . $view . '.php';
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View '$view' not found.");
        }
    }
}
