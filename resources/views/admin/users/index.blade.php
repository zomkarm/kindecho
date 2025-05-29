@extends('layouts.admin')

@section('content')
    <div class="text-xl font-bold mb-4">Users</div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    {{-- Search Form --}}
    <form method="GET" action="{{ route('admin.users') }}" class="mb-4 flex items-center">
        <input
            type="text"
            name="search"
            placeholder="Search by name or email..."
            value="{{ $search }}"
            class="px-3 py-2 border border-gray-300 rounded mr-2 w-full sm:w-64"
        >
        <button type="submit" class="bg-[#422040] text-white px-4 py-2 rounded hover:bg-[#5b2d55]">Search</button>
    </form>

    {{-- Users Table --}}
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-4 py-2 border">ID</th>
                    <th class="text-left px-4 py-2 border">Name</th>
                    <th class="text-left px-4 py-2 border">Email</th>
                    <th class="text-left px-4 py-2 border">Created At</th>
                    <th class="text-left px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="px-4 py-2 border">{{ $user->id }}</td>
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">{{ $user->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 border">
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center px-4 py-4 text-gray-500">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection
