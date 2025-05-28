<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $user = Auth::user();
        $ip = $request->ip();

        $likeQuery = Like::where('post_id', $post->id);

        if ($user) {
            $likeQuery->where('user_id', $user->id);
        } else {
            $likeQuery->where('ip_address', $ip);
        }

        $like = $likeQuery->first();

        if ($like) {
            $like->delete();
            $post->decrement('likes_count');
        } else {
            Like::create([
                'post_id'   => $post->id,
                'user_id'   => $user?->id,
                'ip_address'=> $ip,
            ]);
            $post->increment('likes_count');
        }

        return back();
    }
}

