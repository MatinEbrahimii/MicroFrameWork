<?php

namespace App\Controllers;

use App\Core\Request;
use App\Services\View\View;

class ProductController
{

    public function __construct()
    {
        // echo "im AuthController";
    }
    public function detail(Request $request)
    {
        $product_model = new Product();
        $data = array(
            'product' => $product_model->find($request->param('pid')),
            'form_title' => "فرم لاگین",
        );

        View::load('auth.login-form', $data);
    }
    public function register(Request $request)
    {
        echo "Register page<br>";
    }
}
