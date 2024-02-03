<x-admin-layout>
    <x-slot name="header">
        Edit Permission
    </x-slot>

    <x-cards.default>
        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST"  class="space-y-6">
            @method('PATCH')
            @csrf
            <div>
                <x-forms.label for="name" value="Name" />
                <x-forms.input type="text" name="name" id="name" :value="old('name', $role->name)" required autofocus />
                <x-forms.input-error for="name" class="mt-2" />
            </div>

            <div class="flex justify-end space-x-2">
                <x-buttons.secondary type="button" onclick="history.back()" class="px-3 py-2 text-xs font-medium">Cancel</x-buttons.secondary>
                <x-buttons.primary class="px-3 py-2 text-xs font-medium">Save</x-buttons.primary>
            </div>
        </form>

        <div class="mb-6">
            <x-theme.title>Add permissions to role</x-theme.title>

        </div>
        <div class="flex flex-wrap">
            @if ($role->permissions)
                @forelse($role->permissions as $role_permission)
                    <form method="POST" action="{{ route('admin.roles.permissions.revoke', [$role->id, $role_permission->id]) }}" class="flex space-y-2" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')

                        <x-buttons.delete class="px-3 py-2 text-xs font-medium mr-2">
                            {{ $role_permission->name }}
                        </x-buttons.delete>

                    </form>
                @empty
                    <div class="flex justify-center items-center w-full">
                        <div class="flex flex-col justify-center items-center h-40 space-y-4">
                            <div class="text-orange-500"><i class="fa-regular fa-circle-xmark fa-2xl"></i></div>
                            <p class="text-xl font-bold tracking-tight text-gray-700 dark:text-white">No records found</p>
                        </div>
                    </div>
                @endforelse
            @endif
        </div>
        <form method="POST" action="{{ route('admin.roles.permissions', $role->id) }}" class="mt-4">
            @csrf
            <div>
                <x-forms.label for="permission" value="Permissions" />
                <x-forms.select id="permission" name="permission" autocomplete="permission-name">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                    @endforeach
                </x-forms.select>
                <x-forms.input-error for="permission" class="mt-2" />
            </div>
            <div class="flex justify-end space-x-2 mt-4">
                <x-buttons.primary class="px-3 py-2 text-xs font-medium">Assign</x-buttons.primary>
            </div>
        </form>
    </x-cards.default>
</x-admin-layout>
