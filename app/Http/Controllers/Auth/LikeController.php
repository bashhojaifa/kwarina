<?php

namespace App\Http\Controllers\Auth;

use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function postLikePost(Request $request)
    {
        $postId = $request->input('postId');
        $userId = $request->input('userId');

        $hasLiked = DB::table('likes')
            ->where(['user_id' => $userId, 'post_id' => $postId, 'like' => '1'])
            ->pluck('like');
    }

}
