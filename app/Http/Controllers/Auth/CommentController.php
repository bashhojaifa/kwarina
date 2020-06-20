<?php

namespace App\Http\Controllers\Auth;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->post_id = $post;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;
        $comment->save();

        Toastr::success('Your comment successfully published :)', 'Success');
        return redirect()->back();
    }



    public function commentEdit(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);
        $Comment = Comment::find($request['commentId']);
        $Comment->comment = $request['body'];
        $Comment->update();
        return response()->json(['new_body' => $Comment->comment], 200);
    }


    public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->post->user->id == Auth::id())
        {
            $comment->delete();
            Toastr::success('Comment successfully deleted', 'Success');
        }
        return redirect()->back();
    }

}
