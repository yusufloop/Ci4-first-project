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
                // 'email' => [
                //     'rules' => 'required|valid_email',
                //     'label' => 'Email address', //tambah label. macam apa nama rules yang keluar
                //     'errors' => [
                //         'required' => 'Hey, Email Address is a required field',
                //         'valid_email' => 'Oh, man, Really?? Pls, add a valid email'
                //     ]
                // ],
                // 'password' => 'required|min_length[8]',
                // 'category' => 'in_list[Student, Teacher]',
                // 'date' => [
                //     'rules' => 'required|check_date' ,//check_date addalah custom rules buat sendiri di folder Validations
                //     'label' => 'Date',
                //     'errors' => [
                //         'check_date' => 'You cannot add a date before today'
                //     ]
                //     ]
                'theFile' => [
                    'rules' => 'uploaded[theFile.0]|max_size[theFile, 1024]|is_image[theFile]|', //ext_in is extension in, kau nak specify file jenis apa yang boleh masuk, max_dims width dan height |max_dims[theFile,100,50]
                    'label' => 'the File'
                ]
    
            ];
            if($this->validate($rules)){
                // $file = $this->request->getFile('theFile');
                // if($file->isValid() && !$file->hasMoved()){
                //   // $file->move('./upload/images', 'testName.'.$file->getExtension()); //untuk specify nama images after upload
                //   $file->move('./upload/images',$file->getRandomName());  //random name after upload
                // }

                $files = $this->request->getFiles();
                    foreach($files['theFile']as $file){
                        if($file->isValid() && !$file->hasMoved()){
                            echo $file->getName().'- Real name<br>';
                            $file->move('./upload/images/multiple');  //random name after upload
                            echo $file->getName().'- new name <br> <hr>';
                        }
                    }
                    exit();


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
