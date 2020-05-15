<?php

namespace App\Utilities;

class Input
{

    public static function clean($data)
    {
        // data cleaner 
        $data = stripslashes($data);
        $data = strip_tags('<script></script>');
        $data = filter_var($data, FILTER_SANITIZE_MAGIC_QUOTES);
        return $data;
    }
}
