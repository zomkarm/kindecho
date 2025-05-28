<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\SentimentManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    public function store(Request $request, SentimentManager $sentiment)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:500',
            'mood' => 'required|string|max:50',
            'tag' => 'nullable|string|max:50',
        ]);

        $status = 'approved';

        try {

            $result = $sentiment->analyze($validated['content']);

            if ($result === 'negative') {
                $status = 'pending';
            }
        } catch (\Exception $e) {
            Log::error('Sentiment Analysis failed:', ['error' => $e->getMessage()]);
            $status = 'pending';
        }

        $post = auth()->user()->posts()->create([
            'content' => $validated['content'],
            'mood' => $validated['mood'],
            'tag' => $validated['tag'],
            'status' => $status,
        ]);

        return back()->with('success', 'Post submitted successfully!');
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

    public function loadMorePosts(Request $request)
    {
        $offset = (int) $request->query('offset', 0);
        $posts = Post::where('status', 'approved')->latest()->skip($offset)->take(12)->get();

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
