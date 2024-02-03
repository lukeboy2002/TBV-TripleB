<x-admin-layout>
    @push('styles')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    @endpush

    <x-slot name="header">
        Edit Member
    </x-slot>

    <x-cards.default>
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @method('PUT')
            @csrf

            @if($user->image)
                <div>
                    <x-forms.label for="image" value="Image" />
                    <x-forms.input type="file" name="image" id="image" />
                    <x-forms.input-error for="image" class="mt-2" />
                </div>
            @endif

            <div class="flex justify-between items-center space-x-6">
                <div class="w-1/2">
                    <x-forms.label for="username" value="Username" />
                    <x-forms.input type="text" name="username" id="username" value="{{ old('username') ?? $user->username }}" readonly />
                    <x-forms.input-error for="username" class="mt-2" />
                </div>
                <div class="w-1/2">
                    <x-forms.label for="email" value="Email" />
                    <x-forms.input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') ?? $user->email }}" readonly />
                    <x-forms.input-error for="email" class="mt-2" />
                </div>
            </div>
            <div class="flex justify-end pt-6 space-x-4">
                <x-links.btn-secondary href="{{ url()->previous() }}" class="px-3 py-2 text-xs font-medium">Back</x-links.btn-secondary>
                <x-buttons.primary class="px-3 py-2 text-xs font-medium">Save</x-buttons.primary>
            </div>
        </form>
    </x-cards.default>

    {{--ROLES--}}
    @can('assign:role')
    <x-cards.default>
        <x-theme.title>Add roles to User</x-theme.title>

        <div class="flex flex-wrap">
            @if ($user->roles)
                @forelse($user->roles as $user_role)
                    <form method="POST" action="{{ route('admin.users.roles.revoke', [$user->id, $user_role->id]) }}" class="flex space-y-2" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')

                        <x-buttons.delete class="px-3 py-2 text-xs font-medium mr-2">
                            {{ $user_role->name }}
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

        <form method="POST" action="{{ route('admin.users.roles', $user->id) }}" class="mt-4">
            @csrf
            <div>
                <x-forms.label for="role" value="Roles" />
                <select id="role"
                        name="role"
                        autocomplete="role-name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <x-forms.input-error for="permission" class="mt-2" />
            </div>
            <div class="flex justify-end space-x-2 mt-4">
                <x-buttons.primary class="px-3 py-2 text-xs font-medium">Assign</x-buttons.primary>
            </div>
        </form>
    </x-cards.default>
    @endcan
    {{--PERMISSIONS--}}
    @can('assign:permission')
    <x-cards.default>
        <x-theme.title>Add permissions to User</x-theme.title>


        <div class="flex flex-wrap">
            @if ($user->permissions)
                @forelse($user->permissions as $user_permission)
                    <form method="POST" action="{{ route('admin.users.permissions.revoke', [$user->id, $user_permission->id]) }}" class="flex space-y-2" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')

                        <x-buttons.delete class="px-3 py-2 text-xs font-medium mr-2">
                            {{ $user_permission->name }}
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

        <form method="POST" action="{{ route('admin.users.permissions', $user->id) }}" class="mt-4">
            @csrf
            <div>
                <x-forms.label for="permission" value="Permissions" />
                <select id="permission"
                        name="permission"
                        autocomplete="permission-name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
                <x-forms.input-error for="permission" class="mt-2" />
        </div>
            <div class="flex justify-end space-x-2 mt-4">
                <x-buttons.primary class="px-3 py-2 text-xs font-medium">Assign</x-buttons.primary>
            </div>
        </form>
    </x-cards.default>
    @endcan
    @push('scripts')
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateType);

            const inputElement = document.querySelector('#image');

            const pond = FilePond.create(inputElement, {
                acceptedFileTypes: ['image/*'],
                server: {
                    load: (source, load, error, progress, abort, headers) => {
                        const myRequest = new Request(source);
                        fetch(myRequest).then((res) => {
                            return res.blob();
                        })
                            .then(load);
                    },
                    process: '{{ route('admin.filepond.upload') }}',
                    revert: '{{ route('admin.filepond.revert') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                files: [
                    {
                        source: '{{ Storage::disk('public')->url($user->image) }}',
                        options: {
                            type: 'local',
                        },
                    }
                ],
            });
        </script>
    @endpush
</x-admin-layout>
