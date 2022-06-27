<?php

namespace App\Controllers;

use App\Models\Upload;
use Fluent\Auth\Config\Services;

class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function dashboard()
    {
        $rules = [
            'video' => [
                'rules' => 'ext_in[video,mp4]',
                'label' => 'video'
            ],
            'image' => [
                'rules' => 'uploaded[image]|ext_in[image,png,jpg,gif,jpeg]',
                'label' => 'image'
            ],
            'description' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'label' => 'description'
            ],
        ];

        $data = [];
        $getUserId = Services::auth()->id();
        $model = model(Upload::class);

        $videos = $model->findAll();
        $data = [
            'videos' => $videos
        ];

        if ($this->request->getMethod() == 'post') {
            
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
              
                if(!empty($this->request->getFile('video'))){
                    $data['video'] = $this->request->getFile('video');
                }

                if(!empty($this->request->getFile('image'))){
                    $data['image'] = $this->request->getFile('image');
                }

                if($data['video']->isValid() && !$data['video']->hasMoved()){
                    $data['video']->move('uploads/video', $data['video']->getRandomName());
                }
                if($data['image']->isValid() && !$data['image']->hasMoved()){
                    $data['image']->move('uploads/image', $data['image']->getRandomName());
                }

                $newsData = [
                    'user_id' => $getUserId,
                    'video' => $data['video']->getName(),
                    'image' => $data['image']->getName(),
                    'description' => $this->request->getVar('description')
                ];
                $model->save($newsData);
                $session = session();
                $session->setFlashdata('success','l\'enregistrement reussi');
                return redirect()->back();
            }
        }
        return view('dashboard', $data,['videos' => $videos]);
    }

    public function confirm()
    {
        return 'granted password';
    }
}
