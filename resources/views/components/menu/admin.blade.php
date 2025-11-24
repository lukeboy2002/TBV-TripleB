<div class="flex flex-col">
    @role('admin')
    <x-link.admin href="{{ route('roles.index') }}"
                  :active="request()->routeIs('roles.*')"
                  icon="shield">
        {{ __('Roles') }}
    </x-link.admin>

    <x-link.admin href="{{ route('users.index') }}"
                  :active="request()->routeIs('users.*')"
                  icon="user-cog">
        {{ __('Users') }}
    </x-link.admin>

    @endrole

    <x-link.admin href="{{ route('categories.index') }}"
                  :active="request()->routeIs('categories.index')"
                  icon="tags">
        {{ __('Categories') }}
    </x-link.admin>

    {{--        TODO: POSTINDEX per User--}}
    {{--        <x-link.navigation href=""--}}
    {{--                           icon="users">--}}
    {{--            {{ __('Post') }}--}}
    {{--        </x-link.navigation>--}}

    <x-link.admin href="{{ route('invitations.index') }}"
                  :active="request()->routeIs('invitations.index')"
                  icon="user-plus">
        {{ __('Invite User') }}
    </x-link.admin>

    <x-link.admin href="{{ route('game.create') }}"
                  :active="request()->routeIs('game.create')"
                  icon="dices">
        {{ __('Create Game') }}
    </x-link.admin>
</div>

