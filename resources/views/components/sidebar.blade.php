@php
$navItems = auth()->check() ? [
    ['icon' => 'home', 'label' => 'Wall', 'route' => 'posts.wall'],
    ['icon' => 'plus-circle', 'label' => 'Share', 'route' => 'posts.create'],
    ['icon' => 'folder', 'label' => 'Dashboard', 'route' => 'posts.mine'],
    ['icon' => 'settings', 'label' => 'Settings', 'route' => 'user.settings'],
] : [
    ['icon' => 'home', 'label' => 'Wall', 'route' => 'posts.wall'],
    ['icon' => 'log-in', 'label' => 'Login', 'route' => 'login'],
    ['icon' => 'user-plus', 'label' => 'Signup', 'route' => 'register'],
];
@endphp

<div class="bg-bgcol fixed bottom-0 w-full md:top-0 md:left-0  md:w-16 bg-white border-t md:border-r border-gray-200 rounded-md md:mt-4 md:mb-4 md:ml-2 flex md:flex-col justify-around md:justify-start md:py-6 z-50">
    @foreach ($navItems as $item)
        @php
            $isActive = Route::currentRouteName() === $item['route'];
        @endphp
        <a href="{{ route($item['route']) }}"
           class="flex flex-col items-center md:mb-6 rounded-md hover:text-white text-sm transition {{ $isActive ? 'text-indigo-600 font-semibold' : 'text-gray-600 hover:text-indigo-600' }} hover:bg-blue-700 p-2">
            <div class="w-6 h-6" data-lucide="{{ $item['icon'] }}"></div>
            <span class="hidden md:block text-xs mt-1">{{ $item['label'] }}</span>
        </a>
    @endforeach

    @if(auth()->check())
        <form method="POST" action="{{ route('logout') }}" class="flex flex-col items-center md:mb-6">
            @csrf
            <button type="submit" class="text-gray-600 hover:text-indigo-600 transition p-2 flex flex-col items-center">
                <div class="w-6 h-6" data-lucide="log-out"></div>
                <span class="hidden md:block text-xs mt-1">Logout</span>
            </button>
        </form>
    @endif
</div>
