<?php

namespace App\Helpers;

trait View
{
    function render($template, $param)
    {
        ob_start();
        //extract everything in param into the current scope
        extract($param, EXTR_SKIP);
        include($template);
    }
}