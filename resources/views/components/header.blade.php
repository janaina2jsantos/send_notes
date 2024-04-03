<header class="bg-white shadow">
    <div class="flex max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 justify-{{ $content ?? 'start' }}">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $slot }}
            </h2>
            <a href="{{ $route }}" class="{{ $class }}">{{ $linkText }}</a>
        </div>
    </div>
</header>
