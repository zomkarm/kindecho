@extends('layouts.admin')

@section('content')
    <div class="text-xl font-bold mb-4">Edit Post</div>

    <form method="POST" action="{{ route('admin.posts.update', $post) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Content</label>
            <textarea name="content" class="w-full border px-3 py-2 rounded" rows="5" required>{{ old('content', $post->content) }}</textarea>
        </div>

        <div>
            <label class="block font-semibold">Status</label>
            <select name="status" class="w-full border px-3 py-2 rounded" required>
                <option value="approved" {{ $post->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="pending" {{ $post->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="flagged" {{ $post->status == 'flagged' ? 'selected' : '' }}>Flagged/Rejected</option>
            </select>
        </div>

        <button class="bg-[#422040] text-white px-4 py-2 rounded hover:bg-[#5b2d55]">Update Post</button>
    </form>
@endsection
