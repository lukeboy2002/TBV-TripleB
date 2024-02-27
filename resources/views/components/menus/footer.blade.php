<x-links.primary class="px-3 py-2 text-xs font-medium" href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-links.primary>
<x-links.primary class="px-3 py-2 text-xs font-medium" href="{{ route('team') }}" :active="request()->routeIs('team')">Team</x-links.primary>
<x-links.primary class="px-3 py-2 text-xs font-medium" href="{{ route('posts.index') }}" :active="request()->routeIs('post.index')">Blog</x-links.primary>
<x-links.primary class="px-3 py-2 text-xs font-medium" href="/fotos" :active="request()->routeIs('foto*')">Album</x-links.primary>
<x-links.primary class="px-3 py-2 text-xs font-medium" href="/calender" :active="request()->routeIs('calender*')">Calender</x-links.primary>
