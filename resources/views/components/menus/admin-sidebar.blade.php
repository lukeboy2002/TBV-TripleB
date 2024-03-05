<aside class="fixed top-12 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
       aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
        <ul class="space-y-1">
            {{--            <li>--}}
            {{--                <x-links.admin-sitebar href="{{ route('admin.settings') }}" :active="request()->routeIs('admin.settings')">--}}
            {{--                    <i class="fa-solid fa-chart-pie fa-xl text-gray-500 dark:text-gray-400"></i>--}}
            {{--                    <span class="ml-3">Overview</span>--}}
            {{--                </x-links.admin-sitebar>--}}
            {{--            </li>--}}
            <li>
                <x-links.admin-sitebar href="{{ route('admin.contact.index') }}" :active="request()->routeIs('admin.contacts.*')">
                    <i class="fa-solid fa-envelope text-gray-500 dark:text-gray-400"></i>
                    <div class="flex items-center ml-3">
                        Contact
                        <span class="ml-2 flex w-5 h-5 me-3 bg-teal-500 rounded-full text-xs items-center justify-center">
                                {{ $totalContacts->count() }}
                            </span>
                    </div>
                </x-links.admin-sitebar>
            </li>
            @can('show:role')
                <li>
                    <x-links.admin-sitebar href="{{ route('admin.roles.index') }}" :active="request()->routeIs('admin.roles.*')">
                        <i class="fa-solid fa-user-shield text-gray-500 dark:text-gray-400"></i>
                        <div class="ml-3">Roles</div>
                    </x-links.admin-sitebar>
                </li>
            @endcan
            @can('show:permission')
                <li>
                    <x-links.admin-sitebar href="{{ route('admin.permissions.index') }}" :active="request()->routeIs('admin.permissions.*')">
                        <i class="fa-solid fa-user-tag text-gray-500 dark:text-gray-400"></i>
                        <div class="ml-3">Permissions</div>
                    </x-links.admin-sitebar>
                </li>
            @endcan
            <li>
                <x-links.admin-sitebar href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                    <i class="fa-solid fa-users text-gray-500 dark:text-gray-400"></i>
                    <div class="ml-3">Users</div>
                </x-links.admin-sitebar>
            </li>
            <li>
                <x-links.admin-sitebar href="{{ route('admin.invitations.create') }}" :active="request()->routeIs('admin.invitations.*')">
                    <i class="fa-solid fa-people-arrows text-gray-500 dark:text-gray-400"></i>
                    <div class="ml-3">Invite User / Invitee</div>
                </x-links.admin-sitebar>
            </li>
            <li>
                <x-links.admin-sitebar href="{{ route('admin.categories.index') }}" :active="request()->routeIs('admin.categories.*')">
                    <i class="fa-solid fa-tags text-gray-500 dark:text-gray-400"></i>
                    <div class="ml-3">Categories</div>
                </x-links.admin-sitebar>
            </li>
            <li>
                <x-links.admin-sitebar href="{{ route('admin.posts.index') }}" :active="request()->routeIs('admin.posts.*')">
                    <i class="fa-solid fa-newspaper text-gray-500 dark:text-gray-400"></i>
                    <div class="ml-3">Blogposts</div>
                </x-links.admin-sitebar>
            </li>
            <li>
                <x-links.admin-sitebar href="{{ route('admin.albums.index') }}" :active="request()->routeIs('admin.albums.*')">
                    <i class="fa-solid fa-images text-gray-500 dark:text-gray-400"></i>
                    <div class="ml-3">Albums</div>
                </x-links.admin-sitebar>
            </li>
        </ul>
        <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
            <li>
                <x-links.admin-sitebar href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-arrow-right-from-bracket text-gray-500 dark:text-gray-400"></i>
                    <div class="ml-3">Sign out</div>
                </x-links.admin-sitebar>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>

