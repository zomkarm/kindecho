<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - KindEcho</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Adjust if needed -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-white font-sans antialiased">

<div x-data="{ open: false }" class="min-h-screen flex flex-col md:flex-row">

    <!-- Mobile Topbar -->
    <div class="w-full bg-[#422040] text-white flex items-center justify-between px-4 py-3 md:hidden">
        <div class="text-lg font-bold">KindEcho Admin</div>
        <button @click="open = !open" class="focus:outline-none">
            <!-- Hamburger Icon -->
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path x-show="!open" d="M4 6h16M4 12h16M4 18h16" />
                <path x-show="open" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Sidebar -->
    <aside
        :class="open ? 'block' : 'hidden'"
        class="w-64 bg-[#422040] text-white px-4 py-6 md:block md:relative absolute z-10 md:z-0"
    >
        <div class="text-2xl font-bold mb-6 px-2">KindEcho</div>

        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block w-full px-4 py-3 hover:bg-[#5b2d55] rounded transition-all">
                Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="block px-4 py-3 hover:bg-[#5b2d55] rounded">
                Users
            </a>
            <a href="{{ route('admin.posts.index') }}"  class="block w-full px-4 py-3 hover:bg-[#5b2d55] rounded transition-all">
                Posts
            </a>
            <a href="{{ route('admin.settings.edit') }}"  class="block w-full px-4 py-3 hover:bg-[#5b2d55] rounded transition-all">
                Settings
            </a>
        </nav>

        <form method="POST" action="{{ route('admin.logout') }}" class="mt-8 px-2 border-t border-white/20 pt-4">
            @csrf
            <button class="w-full text-left px-4 py-3 hover:bg-[#5b2d55] rounded transition-all">
                Logout
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-y-auto">
        @yield('content')
    </main>

</div>

</body>
</html>
