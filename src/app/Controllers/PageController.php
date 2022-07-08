<?php

namespace App\Controllers;

class PageController
{
    public function __construct()
    {

    }

    public function home()
    {
        echo 'home page';
    }

    public function blogs()
    {
        echo 'blog page';
    }

    public function blog_detail()
    {
        echo 'blog detail';
    }

    public function about()
    {
        echo 'about';
    }
}
