<ul class="flex flex-col md:space-x-4 space-y-2 md:space-y-0 p-4 font-medium  border border-gray-300 rounded-lg rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:border-gray-700">
    <li>
        <x-links.btn-primary href="{{ route('home') }}" class="px-3 py-2" :active="request()->routeIs('home')">Home</x-links.btn-primary>
    </li>
    <li>
        <x-links.btn-primary href="{{ route('team') }}" class="px-3 py-2" :active="request()->routeIs('team')">Team</x-links.btn-primary>
    </li>
    <li>
        <x-links.btn-primary href="#" class="px-3 py-2">Services</x-links.btn-primary>
    </li>
    <li>
        <x-links.btn-primary href="#" class="px-3 py-2">Pricing</x-links.btn-primary>
    </li>
    <li>
        <x-links.btn-primary href="#" class="px-3 py-2">Contact</x-links.btn-primary>
    </li>
</ul>
