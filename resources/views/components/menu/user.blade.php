@php
    $user = auth()->user();
    $showMenuBorders = $user && (
        $user->hasRole('admin') ||
        $user->can('create:category') ||
        $user->can('create:user') ||
        $user->can('create:game')
    );
@endphp

@if($showMenuBorders)
    <div class="border-t border-secondary/30 my-2"></div>
@endif
@role('admin')
<x-dropdown-link
        href="{{ route('roles.index') }}">
    {{ __('Roles') }}
</x-dropdown-link>
<x-dropdown-link
        href="{{ route('users.index') }}">
    {{ __('Users') }}
</x-dropdown-link>
@endrole

@can('create:category')
    <x-dropdown-link
            href="{{ route('categories.index') }}">
        {{ __('Create category') }}
    </x-dropdown-link>
@endcan

@can('create:user')
    <x-dropdown-link
            href="{{ route('invitations.index') }}">
        {{ __('Invite User') }}
    </x-dropdown-link>
@endcan

@can('create:game')
    <x-dropdown-link href="{{ route('game.create') }}">
        {{ __('Create Game') }}
    </x-dropdown-link>
@endcan

@can('create:album')
    <x-dropdown-link href="{{ route('album.create') }}">
        {{ __('Create Album') }}
    </x-dropdown-link>
@endcan

@can('create:post')
    <x-dropdown-link href="{{ route('post.create') }}">
        {{ __('Create Post') }}
    </x-dropdown-link>
@endcan

@can('create:event')
    <x-dropdown-link href="{{ route('events.create') }}">
        {{ __('Create Event') }}
    </x-dropdown-link>
@endcan

@if($showMenuBorders)
    <div class="border-t border-secondary/30 my-2"></div>
@endif