<?php
namespace App\Controllers;

use Config\Services;

class Image extends BaseController
{

    private function imageManipulation($path, $folder, $fileName, $imageService)
    {
        $savePath = $path. '/' . $folder;
        if(!file_exists($savePath))
             mkdir($savePath, 755);

        $imageService->withFile(src($fileName));

        switch($folder){
        case 'thumbs' :
            $imageService->fit(150,150); //param width and height
            break;
        case 'flip' :
            $imageService->flip('horizontal');
            $imageService->fit(160,90, 'top-right'); // param width length and position
            break;
        case 'rotate' :
            $imageService->rotate(180); //param degree angle
            break;
        }

        return $imageService->save($savePath . '/' . $fileName);
    }
    

    public function index()
    {
        helper(['form','image']);
        $data =[];
        
        if($this->request->getMethod() == 'post')
        {
            $rules = [
               
                'theFile' => [
                    'rules' => 'uploaded[theFile.0]|is_image[theFile]|', //ext_in is extension in, kau nak specify file jenis apa yang boleh masuk, max_dims width dan height |max_dims[theFile,100,50]
                    'label' => 'the File'
                ]
    
            ];
            if($this->validate($rules)){
                // $file = $this->request->getFile('theFile');
                // if($file->isValid() && !$file->hasMoved()){
                //   // $file->move('./upload/images', 'testName.'.$file->getExtension()); //untuk specify nama images after upload
                //   $file->move('./upload/images',$file->getRandomName());  //random name after upload
                // }
                $path = './uploads/images/manipulated/';
                $files = $this->request->getFiles();

                $imageService = Services::image('imagick'); //service ('image')

                $imageService = service('image');

                    foreach($files['theFile']as $file){
                        if($file->isValid() && !$file->hasMoved()){

                            $file->move($path);  //move file to uploaded location
                            $fileName = $file->getName();
                            $data['image'] = $fileName;

                            $this->imageManipulation($path, 'thumbs', $fileName, $imageService);
                            $data['folders'][] = 'thumbs';

                            $this->imageManipulation($path, 'flip', $fileName, $imageService);
                            $data['folders'][] = 'flip';

                            $this->imageManipulation($path, 'rotate', $fileName, $imageService);
                            $data['folders'][] = 'rotate';
                           
                            }
                    }
                    
                //Then do database insertion
                //login user
            }else{
                $data['validation'] = $this->validator;
            }
        }

        return view('image',$data);
    }
    
}
