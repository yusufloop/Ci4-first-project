<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Shop extends BaseController
{
    public function index()
    {
        echo '<h2>This is and admin shop area</h2>';
    }
    public function product($type,$product_id)
    {
        echo '<h2>This is a product admin</h2>';
        // return view('product');
    }
    
}