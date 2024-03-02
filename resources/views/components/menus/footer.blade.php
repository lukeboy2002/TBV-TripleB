<x-links.primary href="{{ route('home') }}" class="px-3 py-2 text-xs font-medium" :active="request()->routeIs('home')">Home</x-links.primary>
<x-links.primary href="{{ route('team') }}" class="px-3 py-2 text-xs font-medium" :active="request()->routeIs('team')">Team</x-links.primary>
<x-links.primary href="{{ route('posts.index') }}" class="px-3 py-2 text-xs font-medium" :active="request()->routeIs('post.index')">Blog</x-links.primary>
<x-links.primary href="{{ route('albums.index') }}" class="px-3 py-2 text-xs font-medium" :active="request()->routeIs('albums.index*')">Album</x-links.primary>
