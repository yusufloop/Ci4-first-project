<?php
namespace App\Controllers;

use App\Models\BlogModel;
use Faker\Provider\Lorem;
use App\Controllers\Admin\Shop as AdminShop;

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

       
        return view('blog',$data);
        
       
    }
    public function post($id)
    {
        $model = new BlogModel();
        $post = $model->find($id);
        if($post)
        {
            $data = [
                'meta_title' => $post['post_title'],
                'title' =>$post['post_title'],
            ];

        }else
        {
            $data = [
                'meta_title' => 'Post not found',
                'title' => 'Post Not found',
            ];

        }
        
        return view('single_post',$data);
        
    }
    public function new()
    {
        $data = [
            'meta_title' =>'new Post',
            'title' =>'Create new post',
        ];

        if($this->request->getMethod() == 'post'){
            $model = new BlogModel();
            $model->save($_POST);
        }
        return view('new_post',$data);
    }
    

}
