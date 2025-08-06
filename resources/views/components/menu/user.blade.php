{{--@if(auth()->user()->can('create:post'))--}}
@can('create:post')
    <x-dropdown-link
            href="{{ route('posts.create') }}">
        {{ __('New Post') }}
    </x-dropdown-link>
@endcan

{{--@endif--}}

{{--@if(auth()->user()->can('view:role'))--}}
{{--    <x-dropdown-link href="{{ route('admin.roles.index') }}">--}}
{{--        Roles--}}
{{--    </x-dropdown-link>--}}
{{--@endif--}}

{{--@if(auth()->user()->can('view:permission'))--}}
{{--    <x-dropdown-link href="{{ route('admin.permissions.index') }}">--}}
{{--        Permissions--}}
{{--    </x-dropdown-link>--}}
{{--@endif--}}

{{--@if(auth()->user()->can('create:user'))--}}
{{--    <x-dropdown-link--}}
{{--            href="{{ route('admin.invitations.index') }}">--}}
{{--        {{ __('Invite User') }}--}}
{{--    </x-dropdown-link>--}}
{{--@endif--}}