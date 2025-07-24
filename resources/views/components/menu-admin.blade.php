<div class="relative">
    <x-link.navigation href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')"
                       icon="layout-dashboard"
                       class="justify-center md:justify-start py-2 px-3 rounded-md hover:bg-background-hover"
                       data-popover-target="tooltip-dashboard">
        <span class="hidden md:inline">Dashboard</span>
    </x-link.navigation>

    <!-- Tooltip for small screens -->
    <div id="tooltip-dashboard" role="tooltip"
         class="md:hidden absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-primary transition-opacity duration-300 bg-background rounded-lg shadow-xs opacity-0 tooltip">
        Dashboard
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</div>

@can('view:role')
    <div class="relative">
        <x-link.navigation href="{{ route('admin.roles.index') }}" icon="notebook"
                           class="justify-center md:justify-start py-2 px-3 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700"
                           data-popover-target="tooltip-users"
                           :active="request()->routeIs('admin.role.*')">
            <span class="hidden md:inline">Roles</span>
        </x-link.navigation>

        <!-- Tooltip for small screens -->
        <div id="tooltip-users" role="tooltip"
             class="md:hidden absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-primary transition-opacity duration-300 bg-background rounded-lg shadow-xs opacity-0 tooltip">
            Roles
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
@endcan

@can('view:permission')
    <div class="relative">
        <x-link.navigation href="{{ route('admin.permissions.index') }}" icon="notebook"
                           class="justify-center md:justify-start py-2 px-3 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700"
                           data-popover-target="tooltip-users"
                           :active="request()->routeIs('admin.permission.*')">
            <span class="hidden md:inline">Permission</span>
        </x-link.navigation>

        <!-- Tooltip for small screens -->
        <div id="tooltip-users" role="tooltip"
             class="md:hidden absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-primary transition-opacity duration-300 bg-background rounded-lg shadow-xs opacity-0 tooltip">
            Permissions
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
@endcan

@can('view:user')
    <div class="relative">
        <x-link.navigation href="{{ route('admin.users.index') }}" icon="users"
                           class="justify-center md:justify-start py-2 px-3 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700"
                           data-popover-target="tooltip-users">
            <span class="hidden md:inline">Users</span>
        </x-link.navigation>

        <!-- Tooltip for small screens -->
        <div id="tooltip-users" role="tooltip"
             class="md:hidden absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-primary transition-opacity duration-300 bg-background rounded-lg shadow-xs opacity-0 tooltip">
            Users
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
@endcan

@can('create:user')
    <div class="relative">
        <x-link.navigation href="#" icon="users"
                           class="justify-center md:justify-start py-2 px-3 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700"
                           data-popover-target="tooltip-users">
            <span class="hidden md:inline">Invite User</span>
        </x-link.navigation>

        <!-- Tooltip for small screens -->
        <div id="tooltip-users" role="tooltip"
             class="md:hidden absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-primary transition-opacity duration-300 bg-background rounded-lg shadow-xs opacity-0 tooltip">
            Invite User
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
@endcan


<div class="relative">
    <x-link.navigation href="#" icon="settings"
                       class="justify-center md:justify-start py-2 px-3 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700"
                       data-popover-target="tooltip-settings">
        <span class="hidden md:inline">Settings</span>
    </x-link.navigation>

    <!-- Tooltip for small screens -->
    <div id="tooltip-settings" role="tooltip"
         class="md:hidden absolute z-50 invisible inline-block px-3 py-2 text-sm font-medium text-primary transition-opacity duration-300 bg-background rounded-lg shadow-xs opacity-0 tooltip">
        Settings
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</div>