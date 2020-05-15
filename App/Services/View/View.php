<?php

namespace App\Services\View;

class View
{
    public static function load($view, $data = array())
    {
        $view = str_replace('.', DIRECTORY_SEPARATOR, $view);
        $full_view_path = BASE_VIEW_PATH . $view . '.php';
        if (file_exists($full_view_path) && is_readable($full_view_path)) {
            extract($data);
            include_once $full_view_path;
        } else {
            echo "Error: view not exists!";
        }
    }


    public static function render($file_path)
    {
        ob_start();
        $theme_file = BASE_PATH . "themes/" . ACTIVE_THEME . "/$file_path";
        include_once $theme_file;
        $tpl_html = ob_get_clean();
        // self::save_cache($file_path, $tpl_html);
        return $tpl_html;
    }

    public static function save_cache($file_path, $tpl_html)
    {
        file_put_contents(BASE_PATH . "cache/" . md5($file_path) . ".cache", $tpl_html);
    }
}
