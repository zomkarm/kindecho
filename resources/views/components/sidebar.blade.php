@php
$navItems = auth()->check() ? [
    ['icon' => '🏠', 'label' => 'Wall', 'route' => 'posts.wall'],
    ['icon' => '➕', 'label' => 'Share', 'route' => 'posts.create'],
    ['icon' => '📂', 'label' => 'Dashboard', 'route' => 'posts.mine'],
    ['icon' => '⚙️', 'label' => 'Settings', 'route' => 'user.settings'],
] : [
    ['icon' => '🏠', 'label' => 'Wall', 'route' => 'posts.wall'],
    ['icon' => '🔐', 'label' => 'Login', 'route' => 'login'],
    ['icon' => '📝', 'label' => 'Signup', 'route' => 'register'],
];
@endphp

<div class="fixed bottom-0 w-full md:top-0 md:left-0 md:h-screen md:w-16 bg-white border-t md:border-r border-gray-200 flex md:flex-col justify-around md:justify-start md:py-6 z-50">
    @foreach ($navItems as $item)
        @php
            $isActive = Route::currentRouteName() === $item['route'];
        @endphp
        <a href="{{ route($item['route']) }}"
           class="flex flex-col items-center md:mb-6 text-sm transition {{ $isActive ? 'text-indigo-600 font-semibold' : 'text-gray-600 hover:text-indigo-600' }}">
            <div class="text-2xl">{{ $item['icon'] }}</div>
            <span class="hidden md:block text-xs mt-1">{{ $item['label'] }}</span>
        </a>
    @endforeach

    @if(auth()->check())
        <form method="POST" action="{{ route('logout') }}" class="flex flex-col items-center md:mb-6">
            @csrf
            <button type="submit" class="text-gray-600 hover:text-indigo-600 transition text-2xl">
                🔓
            </button>
            <span class="hidden md:block text-xs mt-1">Logout</span>
        </form>
    @endif
</div>
