<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Blog extends BaseController
{
    public function index()
    {
        echo '<h2>a LIST OF BLOG POST</h2>';
    }
    public function createNew()
    { 
        return view('blog_form');
    }
    public function saveBlog()
    {
        echo '<pre>';
            print_r($_POST);
        echo '<pre>';
        // return view('blog_form');
    }
    
}