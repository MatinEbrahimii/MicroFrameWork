<?php

namespace App\Middlewares;

use App\Core\Request;
use App\Middlewares\Contract\BaseMiddleware;

class FirefoxBlocker extends BaseMiddleware
{
    public function handle(Request $request)
    {
        $agentKey = 'Gecko/';
        if (stripos($request->agent, $agentKey) !== false) {
            echo "Sorry, Firefox was Blocked , Ba Ehteram ...";
            die();
        }
    }
}
