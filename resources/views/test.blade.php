<!-- Layout Wrapper -->
<div class="flex bg-bgLight min-h-screen">

    <!-- Sidebar -->
    <nav class="fixed bottom-0 w-full md:top-0 md:left-0 md:h-screen md:w-16 bg-white border-t md:border-r border-borderLight flex md:flex-col justify-around md:justify-start md:py-6 z-50">
      @php
        $navItems = [
          ['icon' => '🏠', 'label' => 'Wall', 'route' => 'posts.wall'],
          ['icon' => '➕', 'label' => 'Share', 'route' => 'posts.create'],
          ['icon' => '📂', 'label' => 'Dashboard', 'route' => 'dashboard'],
          ['icon' => '⚙️', 'label' => 'Settings', 'route' => 'profile.edit'],
        ];
      @endphp
      @foreach ($navItems as $item)
        @php $isActive = Route::currentRouteName() === $item['route']; @endphp
        <a href="{{ route($item['route']) }}"
           class="flex flex-col items-center md:mb-6 text-sm
                  {{ $isActive ? 'text-primary font-semibold' : 'text-gray-600 hover:text-primary transition' }}">
          <div class="text-2xl">{{ $item['icon'] }}</div>
          <span class="hidden md:block text-xs mt-1">{{ $item['label'] }}</span>
        </a>
      @endforeach
    </nav>
  
    <!-- Main Content -->
    <main class="flex-1 p-6 md:ml-16">
  
      <h1 class="text-3xl font-bold text-primary mb-6">KindEcho Wall</h1>
  
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($posts as $post)
        <div class="bg-white rounded-lg shadow-md border border-borderLight p-4 flex flex-col">
          <p class="text-textPrimary mb-3">{{ $post->content }}</p>
  
          <div class="mt-auto flex justify-between items-center">
            <div class="text-sm text-textSecondary">— Anonymous</div>
            <button class="text-secondary hover:text-accent transition text-lg">❤️</button>
          </div>
        </div>
        @endforeach
      </div>
  
      {{-- Add lazy loading trigger here --}}
  
    </main>
  </div>
  