@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Admin Settings</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}">
        @csrf

        <label class="block mb-2 font-semibold" for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}" required class="w-full mb-4 p-2 border rounded" />
        @error('name')
            <div class="text-red-600 mb-4">{{ $message }}</div>
        @enderror

        <label class="block mb-2 font-semibold" for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}" required class="w-full mb-4 p-2 border rounded" />
        @error('email')
            <div class="text-red-600 mb-4">{{ $message }}</div>
        @enderror

        <label class="block mb-2 font-semibold" for="password">Password <small>(Leave blank to keep current)</small></label>
        <input type="password" id="password" name="password" class="w-full mb-4 p-2 border rounded" />
        @error('password')
            <div class="text-red-600 mb-4">{{ $message }}</div>
        @enderror

        <label class="block mb-2 font-semibold" for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full mb-4 p-2 border rounded" />

        <button type="submit" class="bg-purple-700 text-white py-2 px-4 rounded hover:bg-purple-800">Update Profile</button>
    </form>
</div>
@endsection
