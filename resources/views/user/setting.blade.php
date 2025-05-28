@extends('layouts.app')

@section('setting')
<div class="max-w-2xl mx-auto space-y-8 mb-20 px-4">
    @if (session('success'))
        <div class="mb-4 text-green-600 font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold text-gray-800">Account Settings</h2>

    <!-- Update Profile Information -->
    <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Update Profile Info</h3>
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('PATCH')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required
                       class="w-full p-3 rounded-lg border border-gray-300 focus:ring focus:ring-indigo-200">
                @error('name')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required
                       class="w-full p-3 rounded-lg border border-gray-300 focus:ring focus:ring-indigo-200">
                @error('email')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-right">
                <button type="submit"
                        class="bg-indigo-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-indigo-700">
                    Update Info
                </button>
            </div>
        </form>
    </div>

    <!-- Change Password -->
    <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Change Password</h3>
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('PATCH')

            <input type="hidden" name="password_change" value="1" />

            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                <input type="password" name="current_password" id="current_password" required
                       class="w-full p-3 rounded-lg border border-gray-300 focus:ring focus:ring-indigo-200">
                @error('current_password')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full p-3 rounded-lg border border-gray-300 focus:ring focus:ring-indigo-200">
                @error('password')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full p-3 rounded-lg border border-gray-300 focus:ring focus:ring-indigo-200">
            </div>

            <div class="text-right">
                <button type="submit"
                        class="bg-indigo-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-indigo-700">
                    Change Password
                </button>
            </div>
        </form>
    </div>

    <!-- Delete Account -->
    <div class="bg-white p-6 rounded-2xl shadow border border-red-200">
        <h3 class="text-lg font-semibold text-red-600 mb-4">Danger Zone</h3>
        <p class="text-sm text-gray-600 mb-4">
            Deleting your account will remove all your posts and data permanently.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}"
              onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
            @csrf
            @method('DELETE')

            <button type="submit"
                class="bg-red-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-red-700">
                Delete My Account
            </button>
        </form>
    </div>
</div>
@endsection
