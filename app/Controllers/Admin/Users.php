<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index()
    {
        echo 'Ini Controller Users Method Index yang ada di dalam folder Controllers/Admin/Users.php';
    }

    public function about($nama = '')
    {
        echo  "Hello, I'm $nama.";
    }
}


