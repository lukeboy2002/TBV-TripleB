<div class="flex items-center space-x-4">
    @if (Route::has('login'))
        @auth
            <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button"
                    aria-expanded="false"
                    data-dropdown-toggle="dropdown">
                <span class="sr-only">Open user menu</span>
                <img class="w-8 h-8 rounded-full"
                    src="{{ asset('storage/'.current_user()->profile_photo_path) }}"
                    alt="user photo"/>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="hidden z-50 my-4 w-48 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl">
                <div class="py-3 px-4">
                    <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ current_user()->username }}</span>
                    <span class="block text-sm text-gray-900 truncate dark:text-white">{{ current_user()->email }}</span>
                </div>
                <ul class="py-1 text-gray-700 dark:text-white" aria-labelledby="dropdown">
                    @unlessrole('user')
                    <li>
                        <x-links.primary href="{{ route('admin.settings') }}" class="block py-2 px-4">Settings</x-links.primary>
                    </li>
                    @endunlessrole
                    <li>
                        <x-links.primary href="{{ route('profile.show', current_user()->username) }}" class="block py-2 px-4">My profile</x-links.primary>
                    </li>
                </ul>
                <ul class="py-1 text-gray-700 dark:text-white" aria-labelledby="dropdown">
                    <li>
                        @unlessrole('user')
                        <x-links.primary href="{{ route('admin.users.index') }}" class="flex items-center py-2 px-4">
                            <i class="fa-solid fa-users mr-2"></i>Users
                        </x-links.primary>
                        <x-links.primary href="{{ route('admin.invitations.create') }}" class="flex items-center py-2 px-4">
                            <i class="fa-solid fa-people-arrows mr-2"></i>Invite User
                        </x-links.primary>
                        <x-links.primary href="{{ route('admin.categories.index') }}" class="flex items-center py-2 px-4">
                            <i class="fa-solid fa-tags mr-2"></i>Categories
                        </x-links.primary>
                        <x-links.primary href="{{ route('admin.posts.index') }}" class="flex items-center py-2 px-4">
                            <i class="fa-solid fa-newspaper mr-2"></i>Post
                        </x-links.primary>
                        <x-links.primary href="{{ route('admin.albums.index') }}" class="flex items-center py-2 px-4">
                            <i class="fa-solid fa-images mr-2"></i>Albums
                        </x-links.primary>
                        @endunlessrole
                    </li>
                </ul>
                <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                    <li>
                        <x-links.primary class="block py-2 px-4" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Sign out
                        </x-links.primary>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <div class="px-2 flex space-x-4">
                <x-links.primary href="{{ route('login') }}" :active="request()->routeIs('login')">
                    <i class="text-orange-500 fa-solid fa-arrow-right-to-bracket mr-2 fa-lg"></i>Login
                </x-links.primary>
                @if (Route::has('register'))
                    <x-links.primary href="{{ route('register') }}" :active="request()->routeIs('register')">
                        <i class="text-orange-500 fa-solid fa-arrow-right-to-bracket mr-2 fa-lg"></i>Register
                    </x-links.primary>
                @endif
            </div>
        @endauth
    @endif
</div>
