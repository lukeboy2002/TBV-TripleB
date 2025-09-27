@can('create:category')
    <x-dropdown-link
            href="{{ route('categories.index') }}">
        {{ __('Category') }}
    </x-dropdown-link>
@endcan