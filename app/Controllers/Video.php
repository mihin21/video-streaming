<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Upload;
use Fluent\Auth\Facades\Auth;

class Video extends BaseController
{
    public function index($id)
    {

        $data = [];
        $model = model(Upload::class);
        $video =  $model->where('upload_id', $id)->join('users', 'users.id = uploads.user_id')->first();

        // if (!$video) {
        //     return view('errors/html/error_404');
        // }

        $comment = model(Comment::class);
        $comments = $comment->where('post_id', $id)->join('users', 'users.id = comments.user_id')->orderBy('comment_id', 'DESC')->find();
        $like = model(Like::class);
        $subscribe = model(Subscribe::class);
        $likes = $like->where('post_id',$id)->countAllResults();  
        $like_user =  $like->where('post_id',$id)->first();  
        $subscribe_user =  $subscribe->where('post_id',$id)->first();   
        $subscribe_count = $subscribe->where('post_id',$id)->countAllResults();   
        $data = [
            'video' => $video,
            'comments' => $comments,
            'likes'  => $likes,
            'like_user' => $like_user,
            'subscribe_user' => $subscribe_user,
            'subscribe_count' => $subscribe_count
        ];

        $model = model(Comment::class);
        if ($this->request->getMethod() == 'post') {

            $model->save([
                'comment' => $this->request->getVar('comment'),
                'user_id' => $this->request->getVar('user_id'),
                'post_id' => $id
            ]);
            $session = session();
            $session->setFlashdata('success', 'Vous venez de commenter cette video');
            return redirect()->back();
        }
        return view('video/video', $data);
    }


    public function like($id)
    {
        $model = model(Like::class);
        $likedata = [
            'user_id' => Auth::user()->id,
            'post_id' => $id
        ];
        $model->save($likedata);
        return redirect()->back();
    }

    
    public function subscribe($id)
    {
        $model = model(Subscribe::class);
        $likedata = [
            'user_id' => Auth::user()->id,
            'post_id' => $id
        ];
        $model->save($likedata);
        return redirect()->back();
    }
}
