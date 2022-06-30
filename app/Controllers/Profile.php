<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function index($id)
    {
        $data=[];
        $model = model(UserModel::class);
        $getUser = $model->find($id);
        $data = [
            'getUser' => $getUser
        ];

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'username'     => 'required',
                'email'        => 'required|valid_email',
                'password'     => 'max_length[8]',
                'image'        => 'uploaded[image]|ext_in[image,png,jpg,gif,jpeg]'
            ];
        
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                if(!empty($this->request->getFile('image'))){
                    $data['image'] = $this->request->getFile('image');
                }
                if($data['image']->isValid() && !$data['image']->hasMoved()){
                    $data['image']->move('uploads/image', $data['image']->getRandomName());
                }
                if(!empty($this->request->getVar('password'))){
                    $data['password'] = $this->request->getVar('password');
                 
                }
                $updateData = [
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'image' => $data['image']->getName(),
                    'password' =>  password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
                ];
               
                $model = model(UserModel::class);
                $model->update($id,$updateData);
                $session = session();
                $session->setFlashdata('success','Modification reussi');
                return redirect()->back();
                
            }
        }
        return view('user/profile',$data);    
    }
}
