@extends('layouts.app')

@section('register')
<div class="p-6 max-w-md mx-auto">
<form method="POST" action="{{ route('register') }}">
    @csrf

    <h2 class="text-xl font-semibold mb-4">Sign Up</h2>

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium">Name</label>
        <input id="name" type="text" name="name" required class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label for="email" class="block text-sm font-medium">Email</label>
        <input id="email" type="email" name="email" required class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label for="password" class="block text-sm font-medium">Password</label>
        <input id="password" type="password" name="password" required class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full border rounded p-2">
    </div>

    <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">Sign Up</button>
</form>
</div>
@endsection