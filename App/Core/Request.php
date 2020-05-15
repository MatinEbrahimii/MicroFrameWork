<?php

namespace App\Core;

use App\Utilities\Input;

class Request
{

    public $method;
    public $uri;
    public $ip;
    public $agent;
    public $referer;
    public $params;     // $_REQUEST

    public function __construct()
    {
        if (SANITIZE_ALL_DATA) {
            $this->params = Input::clean($_REQUEST);
        } else {
            $this->params = $_REQUEST;
        }

        // $keys = array_keys($this->params);
        // foreach ($keys as $key) {
        //     $this->{$key} = $this->param($key);
        // }

        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->agent = $_SERVER['HTTP_USER_AGENT'];
        $this->referer = $_SERVER['HTTP_REFERER'] ?? '';
    }

    public function key_exists($key)
    {
        return in_array($key, array_keys($this->params));
    }

    public function is_in($methods_arr)
    {
        return in_array($this->method, $methods_arr);
    }

    public function param($key)
    {
        return $this->params[$key];
    }

    public function __set($key, $value)
    {
        // if (in_array($key, ['loghman', 'mehrzad'])) {
        //     echo "Persmision Denied!";
        // }
    }

    public function __get($key)
    {
        // echo "<div>propert $name not existed!</div>";
        if ($this->key_exists($key)) {
            return $this->{$key} = $this->param($key);
        } else {
            // notify programmer
        }
    }
}
