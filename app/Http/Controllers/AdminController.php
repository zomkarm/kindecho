<?php

namespace App\Http\Controllers;

use App\Models\Post;

class AdminController extends Controller
{
    public function index()
    {
        $pendingPosts = Post::where('status', 'pending')->latest()->paginate(10);
        return view('admin.pending', compact('pendingPosts'));
    }

    public function approve($postId)
    {
        $post = Post::findOrFail($postId);
        $post->update(['status' => 'approved']);
        return back();
    }

    public function flag($postId)
    {
        $post = Post::findOrFail($postId);
        $post->update(['status' => 'flagged']);
        return back();
    }
}
