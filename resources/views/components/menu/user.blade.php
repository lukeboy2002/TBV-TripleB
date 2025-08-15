@can('create:post')
    <x-dropdown-link
            href="{{ route('posts.create') }}">
        {{ __('New Post') }}
    </x-dropdown-link>
@endcan

@can('create:user')
    <x-dropdown-link
            href="{{ route('invitations.index') }}">
        {{ __('Invite User') }}
    </x-dropdown-link>
@endif
