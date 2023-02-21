<x-links.btn-primair class="px-3 py-2 text-xs font-medium" href="/" :active="request()->routeIs('home')">Home</x-links.btn-primair>
<x-links.btn-primair class="px-3 py-2 text-xs font-medium" href="/team" :active="request()->routeIs('team')">Team</x-links.btn-primair>
<x-links.btn-primair class="px-3 py-2 text-xs font-medium" href="/posts" :active="request()->routeIs('post*')">Blog</x-links.btn-primair>
<x-links.btn-primair class="px-3 py-2 text-xs font-medium" href="/fotos" :active="request()->routeIs('foto*')">Album</x-links.btn-primair>
<x-links.btn-primair class="px-3 py-2 text-xs font-medium" href="/calender" :active="request()->routeIs('calender*')">Calender</x-links.btn-primair>
