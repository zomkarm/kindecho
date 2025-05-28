@extends('layouts.app')

@section('create')
        <h2 class="text-2xl font-extrabold text-indigo-700 mb-6 text-center">Share a Kind Thought 💖</h2>

        @if (session('success'))
            <div class="mb-6 text-green-600 font-semibold text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('posts.store') }}" method="POST" class="space-y-6 max-w-lg mx-auto">
            @csrf

            <!-- Thought Content -->
            <div>
                <label for="content" class="block font-semibold text-gray-700 mb-2">Your Message</label>
                <textarea name="content" id="content" rows="5" required maxlength="500"
                    class="w-full max-w-lg p-4 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400 resize-none"
                    placeholder="Write something kind, anonymous and uplifting...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mood -->
            <div>
                <label for="mood" class="block font-semibold text-gray-700 mb-2">Mood</label>
                <select name="mood" id="mood" required
                    class="w-full max-w-lg p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    <option value="" disabled {{ old('mood') ? '' : 'selected' }}>Select a mood</option>
                    <option value="grateful" {{ old('mood') == 'grateful' ? 'selected' : '' }}>Grateful</option>
                    <option value="hopeful" {{ old('mood') == 'hopeful' ? 'selected' : '' }}>Hopeful</option>
                    <option value="inspired" {{ old('mood') == 'inspired' ? 'selected' : '' }}>Inspired</option>
                    <option value="peaceful" {{ old('mood') == 'peaceful' ? 'selected' : '' }}>Peaceful</option>
                    <option value="happy" {{ old('mood') == 'happy' ? 'selected' : '' }}>Happy</option>
                </select>
                @error('mood')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tag (optional) -->
            <div>
                <label for="tag" class="block font-semibold text-gray-700 mb-2">Tag (optional)</label>
                <input type="text" name="tag" id="tag" maxlength="50"
                    class="w-full max-w-lg p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-400"
                    placeholder="e.g. friendship, family, work" value="{{ old('tag') }}">
                @error('tag')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div>
                <button type="submit"
                    class="w-full max-w-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition">
                    Share Kindness ✨
                </button>
            </div>
        </form>
@endsection
