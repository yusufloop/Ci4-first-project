<?php
namespace App\Controllers;

use App\Controllers\Admin\Shop as AdminShop;
use Faker\Provider\Lorem;

class Blog extends BaseController
{
    public function index()
    {
        $data = [
            'meta_title' =>'CodeIgniter 4 Blogs',
            'title' =>'This is a blog Page',
        ];

        $posts = ['Title 1','Title 2','Title 3'];
        $data['posts'] = $posts;

        echo view('templates/header', $data);
        echo view('blog');
        echo view('templates/footer');
        // return view('blog');
    }
    public function post()
    {
        $data = [
            'meta_title' =>'CodeIgniter 4 Post Page',
            'title' =>'This is a Awesome Blog',
        ];

        echo view('templates/header',$data);
        echo view('single_post');
        echo view('templates/footer');
    }
    

}
