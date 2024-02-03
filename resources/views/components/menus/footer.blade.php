<x-links.primary class="px-3 py-2 text-xs font-medium" href="/" :active="request()->routeIs('home')">Home</x-links.primary>
<x-links.primary class="px-3 py-2 text-xs font-medium" href="/team" :active="request()->routeIs('members')">Team</x-links.primary>
<x-links.primary class="px-3 py-2 text-xs font-medium" href="/posts" :active="request()->routeIs('post*')">Blog</x-links.primary>
<x-links.primary class="px-3 py-2 text-xs font-medium" href="/fotos" :active="request()->routeIs('foto*')">Album</x-links.primary>
<x-links.primary class="px-3 py-2 text-xs font-medium" href="/calender" :active="request()->routeIs('calender*')">Calender</x-links.primary>
