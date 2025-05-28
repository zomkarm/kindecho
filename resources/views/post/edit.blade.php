@extends('layouts.app')

@section('edit')
<div class="pt-6 px-4 md:ml-16 max-w-2xl mx-auto mb-20">
    <div class="bg-white shadow rounded-2xl p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Edit Your Thought ✏️</h2>

        @if (session('success'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Thought Content -->
            <div>
                <label for="content" class="block font-semibold text-gray-700 mb-1">Your Message</label>
                <textarea name="content" id="content" rows="4" required maxlength="500"
                    class="w-full p-3 rounded-lg border border-gray-300 focus:ring focus:ring-indigo-200"
                    placeholder="Write something kind...">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Mood -->
            <div>
                <label for="mood" class="block font-semibold text-gray-700 mb-1">Mood</label>
                <select name="mood" id="mood" required
                    class="w-full p-3 rounded-lg border border-gray-300 focus:ring focus:ring-indigo-200">
                    <option value="">Select a mood</option>
                    @foreach (['grateful', 'hopeful', 'inspired', 'peaceful', 'happy'] as $mood)
                        <option value="{{ $mood }}" {{ old('mood', $post->mood) === $mood ? 'selected' : '' }}>
                            {{ ucfirst($mood) }}
                        </option>
                    @endforeach
                </select>
                @error('mood')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tag -->
            <div>
                <label for="tag" class="block font-semibold text-gray-700 mb-1">Tag (optional)</label>
                <input type="text" name="tag" id="tag" maxlength="50"
                    class="w-full p-3 rounded-lg border border-gray-300 focus:ring focus:ring-indigo-200"
                    value="{{ old('tag', $post->tag) }}">
                @error('tag')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit -->
            <div>
                <button type="submit"
                    class="w-full bg-indigo-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-indigo-700 transition">
                    Update Thought 💾
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
