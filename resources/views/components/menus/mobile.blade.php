<x-links.dropdown class="block" href="/" :active="request()->routeIs('home')">Home</x-links.dropdown>
<x-links.dropdown class="block" href="/team" :active="request()->routeIs('team')">Team</x-links.dropdown>
<x-links.dropdown class="block" href="/posts" :active="request()->routeIs('post*')">Blog</x-links.dropdown>
<x-links.dropdown class="block" href="/fotos" :active="request()->routeIs('foto*')">Album</x-links.dropdown>
<x-links.dropdown class="block" href="/calender" :active="request()->routeIs('calender*')">Calender</x-links.dropdown>
