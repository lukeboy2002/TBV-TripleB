<x-card.side>
    <x-slot name="header">Menu</x-slot>

    <div class="flex flex-col gap-y-4">
        @role('admin')
        <div class="items-center flex gap-2 px-1 text-base font-medium leading-5 text-primary">
            <x-lucide-lock class="w-6 h-6 sm:w-5 sm:h-5"/>
            {{ __('Roles & Permissions') }}
        </div>
        <div class=" pl-6 flex flex-col gap-4
            ">
            <x-link.navigation href="{{ route('roles.index') }}"
                               :active="request()->routeIs('roles.index')">
                {{ __('Roles') }}
            </x-link.navigation>
            <x-link.navigation href="{{ route('users.index') }}"
                               :active="request()->routeIs('users.index')">
                {{ __('Users') }}
            </x-link.navigation>
        </div>

        @endrole
        <x-link.navigation href="{{ route('categories.index') }}"
                           :active="request()->routeIs('categories.index')"
                           icon="tags">
            {{ __('Categories') }}
        </x-link.navigation>

        {{--        TODO: POSTINDEX per User--}}
        {{--        <x-link.navigation href=""--}}
        {{--                           icon="users">--}}
        {{--            {{ __('Post') }}--}}
        {{--        </x-link.navigation>--}}

        <x-link.navigation href="{{ route('invitations.index') }}"
                           :active="request()->routeIs('invitations.index')"
                           icon="user-plus">
            {{ __('Invite User') }}
        </x-link.navigation>

        <x-link.navigation href="{{ route('game.create') }}"
                           :active="request()->routeIs('game.create')"
                           icon="dices">
            {{ __('Create Game') }}
        </x-link.navigation>
    </div>
</x-card.side>

