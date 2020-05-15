<?php

namespace App\Controllers;

use App\Core\Request;
use App\Models\User;
use App\Services\View\View;

class AuthController
{

    public function __construct()
    {
        // echo "im AuthController";
    }
    public function login(Request $request)
    {
        $userModel = new User();

        $data = array(
            'total_users' => $userModel->read()
        );

        View::load('auth.login-form', $data);
    }
    public function register(Request $request)
    {
        echo "Register page<br>";
    }
}
