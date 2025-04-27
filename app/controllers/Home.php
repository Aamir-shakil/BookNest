<?php
//Responsible for handling applicatioon logic and rendering views for the home page.
class Home extends Controller
{
    public function index()
    {
        $this->view('home/index', ['title' => 'Home Page']);
    }
}
