<?php
return array(
    '/' => [
        'target' => 'HomeController@index'
    ],
    '/login' => [
        'method' => 'get|post',
        'target' => 'AuthController@login',
        'middleware' => 'FirefoxBlocker'
    ],
    '/auth/register' => [
        'method' => 'get|post',
        'target' => 'AuthController@register'
    ]
);
