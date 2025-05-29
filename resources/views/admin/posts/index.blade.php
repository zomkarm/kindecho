@extends('layouts.admin')

@section('content')
    <div class="text-xl font-bold mb-4">Posts Management</div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    {{-- Filter --}}
    <form method="GET" class="mb-4 flex items-center gap-2">
        <label for="status">Filter by Status:</label>
        <select name="status" onchange="this.form.submit()" class="border px-3 py-2 rounded">
            <option value="">All</option>
            <option value="approved" {{ $status == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="flagged" {{ $status == 'flagged' ? 'selected' : '' }}>Rejected</option>
        </select>
    </form>

    {{-- Posts Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border shadow rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Content</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Created</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td class="border px-4 py-2">{{ $post->id }}</td>
                        <td class="border px-4 py-2">{{ Str::limit($post->content, 40) }}</td>
                        <td class="border px-4 py-2 capitalize">{{ $post->status }}</td>
                        <td class="border px-4 py-2">{{ $post->created_at->format('Y-m-d') }}</td>
                        <td class="border px-4 py-2 flex gap-2">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center px-4 py-4 text-gray-500">No posts found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $posts->links() }}
    </div>
@endsection
