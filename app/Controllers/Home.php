<?php

// File Testing

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function hello()
    {
        return 'Hello World!';
    }
}


