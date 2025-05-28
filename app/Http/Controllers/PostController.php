<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Show the KindEcho wall with all approved posts.
     */
    public function index(Request $request)
    {
        $query = Post::query()
            ->where('status', 'approved')
            ->latest();

        // Optional filters
        if ($request->has('tag')) {
            $query->where('tag', $request->tag);
        }

        if ($request->has('mood')) {
            $query->where('mood', $request->mood);
        }

        $posts = $query->paginate(10);

        return view('post.wall', compact('posts'));
    }

    /**
     * Show the post creation form.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly submitted kind/positive post.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|min:10|max:500',
            'mood'    => 'required|string|max:50',
            'tag'     => 'nullable|string|max:50',
        ]);

        Post::create([
            'user_id'  => Auth::id(),
            'content'  => $request->input('content'),
            'mood'     => $request->input('mood'),
            'tag'      => $request->input('tag'),
            'status'   => 'approved', // If using moderation, change to 'pending'
            'sentiment'=> null, // Optional: can be auto-populated by analysis later
        ]);

        return redirect()->route('posts.mine')->with('success', 'Your kind thought was posted!');
    }

    /**
     * (Optional) View a single post.
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->where('status', 'approved')->firstOrFail();
        return view('post.show', compact('post'));
    }

    public function wall()
    {
        return view('post.wall');
    }

    /*public function load(Request $request)
    {
        $offset = $request->input('offset', 0);
        $limit = 12;

        $posts = \App\Models\Post::latest()->skip($offset)->take($limit)->get();

        return response()->json($posts);
    }*/

    public function loadMorePosts(Request $request)
    {
        $offset = (int) $request->query('offset', 0);
        $posts = Post::latest()->skip($offset)->take(12)->get();

        if ($posts->isEmpty()) {
            return response()->json(['html' => '', 'done' => true]);
        }

        $html = '';
        foreach ($posts as $post) {
            $html .= view('components.post-card', compact('post'))->render();
        }

        return response()->json(['html' => $html, 'done' => false]);
    }


    public function mine()
    {
        $posts = auth()->user()->posts()->latest()->paginate(10);

        return view('post.mine', compact('posts'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $request->validate([
            'content' => 'required|max:500',
            'mood' => 'required',
            'tag' => 'nullable|max:50',
        ]);

        $post->update($request->only('content', 'mood', 'tag'));

        return redirect()->route('posts.mine')->with('success', 'Post updated!');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('posts.mine')->with('success', 'Post deleted!');
    }



}
