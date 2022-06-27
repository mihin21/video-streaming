<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Upload;

class Video extends BaseController
{
    public function index($id)
    {
        $data = [];
        $model = model(Upload::class);
        $video =  $model->find($id);
        $data = [
            'video' => $video
        ];
        return view('video/video',$data);
    }
}
