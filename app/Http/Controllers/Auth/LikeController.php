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
        $likeState = null;
        $postId = $request->input('postId');
        $userId = $request->input('userId');

        $hasLiked = DB::table('likes')
            ->where(['user_id' => $userId, 'post_id' => $postId, 'like' => '1'])
            ->pluck('like');

        if (0 == count($hasLiked)) {
            $likeState = true;
            DB::table('likes')
                ->updateOrInsert(
                    ['user_id' => $userId, 'post_id' => $postId],
                    ['like' => '1']
                );
        } elseif (1 == count($hasLiked)) {
            $likeState = false;
            DB::table('likes')
                ->updateOrInsert(
                    ['user_id' => $userId, 'post_id' => $postId],
                    ['like' => '0']
                );
        }

        $likes = Post::find($postId)->likes()->where(['like' => '1'])->get();
        $totalLikes = count($likes);

        return response()->json([
            'status' => true,
            'likeState' => $likeState,
            'likes' => $totalLikes,
        ]);
    }
}
