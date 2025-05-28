@extends('layouts.app')

@section('login')
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md" @click.stop>
        <h2 class="text-xl font-bold mb-4">Log In</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required class="mt-1 w-full border rounded p-2" />
                @error('email') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required class="mt-1 w-full border rounded p-2" />
                @error('password') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Log In</button>
            </div>
        </form>
    </div>
</div>
@endsection