<?php

class Passwordreset extends Controller
{
    public function index()
    {
        $this->view('home/index', ['title' => 'Password Reset']);
    }
}
