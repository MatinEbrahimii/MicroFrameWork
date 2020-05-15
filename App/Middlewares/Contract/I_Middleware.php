<?php

namespace App\Middlewares\Contract;

use App\Core\Request;

interface I_Middleware
{
    public function handle(Request $request);
}
