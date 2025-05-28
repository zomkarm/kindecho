<div class="flex h-full">
    <div class="flex flex-col justify-between h-full w-full bg-white rounded-2xl shadow border border-gray-200 p-5 hover:shadow-lg transition">
        <div>
            <div class="text-sm mb-2 text-gray-500">
                Mood: <span class="font-semibold capitalize text-green-600">{{ $post->mood }}</span>
                @if ($post->tag)
                    • Tag: <span class="text-indigo-500 font-semibold">#{{ $post->tag }}</span>
                @endif
            </div>
            <div class="text-lg font-medium leading-snug text-gray-800 line-clamp-5">
                “{{ $post->content }}”
            </div>
        </div>

        <div class="flex items-center justify-between mt-4">
            <form method="POST" action="{{ route('post.like', $post->id) }}">
                @csrf
                <button type="submit"
                    class="text-sm text-pink-600 hover:text-pink-800 flex items-center gap-1 font-semibold">
                    ❤️ {{ $post->likes_count ?? 0 }}
                </button>
            </form>
            <button type="button"
                onclick="navigator.clipboard.writeText('{{ url('/posts/' . $post->id) }}'); alert('Post link copied!')"
                class="text-sm text-blue-500 hover:text-blue-700 flex items-center gap-1 font-semibold">
                🔗 Share
            </button>
        </div>
    </div>
</div>
