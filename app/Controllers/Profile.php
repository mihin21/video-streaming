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
        return view('user/profile',$data);

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'username'              => 'required',
                'email'                 => 'required|valid_email',
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
                $updateData = [
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'image' => $data['image']->getName(),
                ];
                if(!empty($this->request->getVar('password'))){
                    $data['password'] = $this->request->getVar('password');
                }
                $model = model(UserModel::class);
                $model->update($id,$updateData);
                $session = session();
                $session->setFlashdata('success','Modification reussi');
                return redirect()->back();
                
            }
        }
    }
}
