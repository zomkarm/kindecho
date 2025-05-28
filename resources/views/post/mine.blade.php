@extends('layouts.app')

@section('dashboard')
<div class="pt-6 px-4 md:ml-16 max-w-3xl mx-auto mb-20">
    <h1 class="text-2xl font-bold mb-6">My Kind Posts 💖</h1>

    @if(session('success'))
        <div class="mb-4 text-green-600 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    @if($posts->isEmpty())
        <p class="text-gray-600">You haven’t shared any posts yet. <a href="{{ route('posts.create') }}" class="text-indigo-600 underline">Share one now!</a></p>
    @else
        <div class="space-y-6">
            @foreach($posts as $post)
    <div class="bg-white shadow rounded-2xl p-6 relative">
        <p class="text-gray-800 mb-3 whitespace-pre-wrap">{{ $post->content }}</p>
        <div class="flex justify-between text-sm text-gray-500">
            <span>Mood: <strong class="capitalize">{{ $post->mood }}</strong></span>
            <span>Tag: {{ $post->tag ?? 'None' }}</span>
            <span>Posted: {{ $post->created_at->format('M d, Y') }}</span>
        </div>

        <!-- Action buttons -->
        <div class="flex gap-3 mt-4 text-sm">
            <a href="{{ route('posts.edit', $post->id) }}"
               class="text-indigo-600 font-semibold hover:underline">Edit</a>

            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 font-semibold hover:underline">Delete</button>
            </form>
        </div>
    </div>
@endforeach

        </div>

        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection
