<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class CustomModel{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db;
    }

    function all()
    {
        // "SELECT * FROM posts"

        return $this ->db->table('posts')->get()->getResult();

    }
    function where()
    {
        // "SELECT * FROM posts"

         $this->db->table('posts')
                        ->where(['post_id >' => 90])
                        ->where(['post_id <' => 95])
                        ->where(['post_id !=' => 91])
                        ->orderBy('post_id', 'ACS')
                        ->get()
                        ->getRow();

    }
    function join()
    {
        // "SELECT * FROM posts"

        return $this->db->table('posts')
                        ->where('post_id >', 50)
                        ->where('post_id <', 60)
                        ->join('users', 'posts.post_author = users.user_id', 'lrft')
                        ->get()
                        ->getResult();

    }
    function like()
    {
        // "SELECT * FROM posts"

        return $this->db->table('posts')
                        ->like('post_content', 'same', 'both') //%string% , %string , string%
                        ->join('users', 'posts.post_author = users.user_id', 'lrft')
                        ->get()
                        ->getResult();

    }
    function grouping()
    {
        // "SELECT * FROM posts where (post_id = 25 AND post_date < 1990-01-01 00:00:00) OR post_author = 10"

        return $this->db->table('posts')
                        ->groupStart()
                            ->where([
                                'post_id >' => '25',
                                'post_created_at >' => '1990-01-01 00:00:00'
                                ])
                        ->groupEnd()
                        ->orWhere('post_author', 10)
                        ->join('users', 'posts.post_author = users.user_id', 'lrft')
                        ->get()
                        ->getResult();

    }
    function whereIn()
    {
        $emails = ['glenda06@example.org','josefina.bechtelar@example.net','cyril.kub@example.net'];
        return $this->db->table('posts')
                        ->groupStart()
                            ->where([
                                'post_id >' => '25',
                                'post_created_at >' => '1990-01-01 00:00:00'
                                ])
                        ->groupEnd()
                        ->orWhereIn('email', $emails)
                        ->join('users', 'posts.post_author = users.user_id', 'lrft')
                        ->limit(5,4)
                        ->get()
                        ->getResult();

    }


    function getPosts()
    {
        $builder = $this->db->table('posts');
        $builder->join('users','posts.post_author = users.user_id');
        $posts = $builder->get()->getResult();
        return $posts;
    }

    function getUsers($limit = false){
        $builder = $this->db->table('users');
        if($limit)
            $builder->limit($limit);

        $posts = $builder->get()->getResult();
        return $posts;
    }
    function getAnotherUsers($limit = false){
        // $this->db->setDatabase();
        $builder = $this->db->table('users1');
        if($limit)
            $builder->limit($limit);

        $posts = $builder->get()->getResult();
        return $posts;
    }
    function createUser(){
        $rand = rand(0,10000);


        $this->db->transStart();
        $data = [
            'email' => 'test' . $rand . '@test.com',
            'password' => sha1(time().''. $rand)
        ];
        $builder = $this->db->table('users');
        $builder->insert($data);
        $id = $this->db->insertID();

        $postData =[
            'post_title' => 'Test title' . $rand,
            'post_content' => 'Post description whathever. Subscribe',
            'post_author' => $id
        ];

        $builder = $this->db->table('posts');
        $builder->insert($postData);
        $this->db->transComplete();
    }
}
