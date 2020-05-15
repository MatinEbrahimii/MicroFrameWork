<?php

function config($name)
{
    $config = include BASE_PATH . "configs/$name.php";
    return $config;
}


function removeEmptyMembers($array)
{
    return array_filter($array, function ($a) {
        return trim($a) !== "";
    });
}
