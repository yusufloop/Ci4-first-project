<?php

namespace App\Controllers;

class Shop extends BaseController
{
    public function index()
    {
        return view('shop');
    }
    public function product($type,$product_id)
    {
        echo '<h2>This is a product: '.$type.' with and id: '.$product_id.'</h2>';
        // return view('product');
    }
    // protected function adminCheck()
    // {
    //     echo 'THis is a protected area';
    // }
}
