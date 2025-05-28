<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>KindEcho</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Laravel Vite -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body
    class="bg-gray-100 text-gray-800"
    x-data="{ currentView: '{{ Route::currentRouteName() }}' }"
      x-init="
        if (!currentView || currentView === '') {
          currentView = 'posts.wall';
        }
        console.log('Current view is', currentView);
      ">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('components.sidebar')

        <main class="ml-0 md:ml-16 flex-1 transition-all duration-300">
            <!-- Wall content -->
            <div
                id="content"
                x-show="currentView === 'posts.wall'"
                x-cloak
                class="p-4"
            >
                @yield('wall')
            </div>

            <!-- Login content -->
            <div
                id="loginContent"
                x-show="currentView === 'login'"
                x-cloak
                class="flex justify-center items-center min-h-screen p-4"
            >
                <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
                    @yield('login')
                </div>
            </div>

            <!-- Register content -->
            <div
                id="registerContent"
                x-show="currentView === 'register'"
                x-cloak
                class="flex justify-center items-center min-h-screen p-4"
            >
                <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
                    @yield('register')
                </div>
            </div>

            <!-- Create Post content -->
            <div
                id="createPostContent"
                x-show="currentView === 'posts.create'"
                x-cloak
                class="flex justify-center items-center min-h-screen p-4"
            >
                <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
                    @yield('create')
                </div>
            </div>

            <!-- Dashboard content -->
            <div
                id="dashboardContent"
                x-show="currentView === 'posts.mine'"
                x-cloak
                class="flex justify-center items-center min-h-screen p-4"
            >
                <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
                    @yield('dashboard')
                </div>
            </div>

            <!-- Post Edit content -->
            <div
                id="postEditContent"
                x-show="currentView === 'posts.edit'"
                x-cloak
                class="flex justify-center items-center min-h-screen p-4"
            >
                <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
                    @yield('edit')
                </div>
            </div>

            <!-- Profile Setting content -->
            <div
                id="profileSettingContent"
                x-show="currentView === 'user.settings'"
                x-cloak
                class="flex justify-center items-center min-h-screen p-4"
            >
                <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6">
                    @yield('setting')
                </div>
            </div>
        </main>
    </div>

    {{-- Alpine.js script loaded above --}}
</body>
</html>
