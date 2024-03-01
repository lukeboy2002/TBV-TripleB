<aside
    class="fixed top-12 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidenav"
    id="drawer-navigation"
>
    <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
        <ul class="space-y-2">
            <li>
                <x-links.admin-sitebar href="{{ route('admin.settings') }}" :active="request()->routeIs('admin.settings')">
                    <i class="fa-solid fa-chart-pie fa-xl text-gray-500 dark:text-gray-400"></i>
                    <span class="ml-3">Overview</span>
                </x-links.admin-sitebar>
            </li>
            @can('show:role')
                <x-theme.divider_title title="Roles and Permissions" />
                <li>
                    <x-links.admin-sitebar href="{{ route('admin.roles.index') }}" :active="request()->routeIs('admin.roles.*')">
                        <i class="fa-solid fa-user-shield fa-xl text-gray-500 dark:text-gray-400"></i>
                        <span class="ml-3">Roles</span>
                    </x-links.admin-sitebar>
                </li>
            @endcan
            @can('show:permission')
                <li>
                    <x-links.admin-sitebar href="{{ route('admin.permissions.index') }}" :active="request()->routeIs('admin.permissions.*')">
                        <i class="fa-solid fa-user-tag fa-xl text-gray-500 dark:text-gray-400"></i>
                        <span class="ml-3">Permissions</span>
                    </x-links.admin-sitebar>
                </li>
            @endcan
            <x-theme.divider_title title="Users" />

            <li>
                <x-links.admin-sitebar href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users.*')">
                    <i class="fa-solid fa-users fa-xl text-gray-500 dark:text-gray-400"></i>
                    <span class="ml-3">Users</span>
                </x-links.admin-sitebar>
            </li>
            <li>
                <x-links.admin-sitebar href="{{ route('admin.invitations.create') }}" :active="request()->routeIs('admin.invitations.*')">
                    <i class="fa-solid fa-people-arrows fa-xl text-gray-500 dark:text-gray-400"></i>
                    <span class="ml-3">Invite User / Invitee</span>
                </x-links.admin-sitebar>
            </li>
            <x-theme.divider_title title="Posts" />
            <li>
                <x-links.admin-sitebar href="{{ route('admin.categories.index') }}" :active="request()->routeIs('admin.categories.*')">
                    <i class="fa-solid fa-tags fa-xl text-gray-500 dark:text-gray-400"></i>
                    <span class="ml-3">Categories</span>
                </x-links.admin-sitebar>
            </li>
            <li>
                <x-links.admin-sitebar href="{{ route('admin.posts.index') }}" :active="request()->routeIs('admin.posts.*')">
                    <i class="fa-solid fa-newspaper fa-xl text-gray-500 dark:text-gray-400"></i>
                    <span class="ml-3">Blogposts</span>
                </x-links.admin-sitebar>
            </li>
            <x-theme.divider_title title="Albums" />
            <li>
                <x-links.admin-sitebar href="{{ route('admin.albums.index') }}" :active="request()->routeIs('admin.albums.*')">
                    <i class="fa-solid fa-images fa-xl text-gray-500 dark:text-gray-400"></i>
                    <span class="ml-3">Albums</span>
                </x-links.admin-sitebar>
            </li>
        </ul>
        <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
            <li>
                <x-links.admin-sitebar href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-arrow-right-from-bracket fa-xl text-gray-500 dark:text-gray-400"></i>
                    <span class="ml-3">Sign out</span>
                </x-links.admin-sitebar>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</aside>
