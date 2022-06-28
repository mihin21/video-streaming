<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Comment;
use App\Models\Upload;

class Video extends BaseController
{
    public function index($id )
    {
     
        $data = [];
        $model = model(Upload::class);
        $video =  $model->where('upload_id',$id)->join('users','users.id = uploads.user_id')->first();

        if (!$video) {
            return view('errors/html/error_404');
        }

        $comment = model(Comment::class);
        $comments = $comment->where('post_id',$id)->join('users','users.id = comments.user_id')->orderBy('comment_id','DESC')->find();
        $data = [
            'video' => $video,
          'comments' => $comments
        ];

        $model = model(Comment::class);
        if ($this->request->getMethod() == 'post') {
           
            $model->save( [
                'comment' => $this->request->getVar('comment'),
                'user_id' => $this->request->getVar('user_id'),
                'post_id' => $id
            ]);
            $session = session();
            $session->setFlashdata('success','Vous venez de commenter cette video');
            return redirect()->back();
        }
        return view('video/video',$data);
        
    }
}
