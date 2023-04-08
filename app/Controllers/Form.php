<?php
namespace App\Controllers;

class Form extends BaseController
{
    public function index()
    {
        helper(['form']);
        $data =[];
        $data['categories'] = [
            'Student',
            'Teacher',
            'Principle'
        ];
        
        if($this->request->getMethod() == 'post')
        {
            $rules = [
                'email' => [
                    'rules' => 'required|valid_email',
                    'label' => 'Email address', //tambah label. macam apa nama rules yang keluar
                    'errors' => [
                        'required' => 'Hey, Email Address is a required field',
                        'valid_email' => 'Oh, man, Really?? Pls, add a valid email'
                    ]
                ],
                'password' => 'required|min_length[8]',
                'category' => 'in_list[Student, Teacher]',
                'date' => [
                    'rules' => 'required|check_date' ,//check_date addalah custom rules buat sendiri di folder Validations
                    'label' => 'Date',
                    'errors' => [
                        'check_date' => 'You cannot add a date before today'
                    ]
                    ]
    
            ];
            if($this->validate($rules)){
                return redirect()->to('/form/success');
                //Then do database insertion
                //login user
            }else{
                $data['validation'] = $this->validator;
            }
        }

        return view('form',$data);
    }

    function success()
    {
        return ' HEy, you have pass the validation. Congratz!';
    }
    
}
