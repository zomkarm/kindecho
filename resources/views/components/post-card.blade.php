<div class="flex h-full bg-white rounded-3xl">
    <div class="flex flex-col justify-between h-full w-full backdrop-blur-md rounded-3xl shadow-md  p-5 hover:shadow-xl transition-all duration-300 group relative overflow-hidden">

        {{-- Decorative gradient glow (illusion effect) --}}
        
        <div class="relative z-10">
            <div class="text-xs mb-3 text-gray-500 space-x-2">
                <span class="px-2 py-1 bg-green-100 text-green-600 rounded-full text-xs font-semibold">
                    {{ ucfirst($post->mood) }}
                </span>

                @if ($post->tag)
                    <span class="px-2 py-1 bg-indigo-100 text-indigo-500 rounded-full text-xs font-semibold">
                        #{{ $post->tag }}
                    </span>
                @endif
            </div>

            <div class="text-lg font-serif text-[#302B63]  leading-relaxed line-clamp-5 italic">
                “{{ $post->content }}”
            </div>
        </div>

        <div class="flex items-center justify-between mt-6 relative z-10">
            <form method="POST" action="{{ route('post.like', $post->id) }}">
                @csrf
                <button type="submit"
                    class="flex items-center gap-2 text-sm text-pink-600 hover:text-pink-800 font-semibold transition">
                    <div class="bg-pink-100 p-1 rounded-full">
                        <div data-lucide="heart" class="w-4 h-4"></div>
                    </div>
                    {{ $post->likes_count ?? 0 }}
                </button>
            </form>

            <button type="button"
                onclick="navigator.clipboard.writeText('{{ url('/posts/' . $post->id) }}'); alert('Post link copied!')"
                class="flex items-center gap-2 text-sm text-blue-500 hover:text-blue-700 font-semibold transition">
                <div class="bg-blue-100 p-1 rounded-full">
                    <div data-lucide="link-2" class="w-4 h-4"></div>
                </div>
                Share
            </button>
        </div>
    </div>
</div>
