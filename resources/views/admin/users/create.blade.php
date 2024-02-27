<x-admin-layout>
    @push('styles')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
    @endpush

    <x-slot name="header">
        New Member
    </x-slot>

    <x-cards.default>
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
            @csrf
            <div>
                <x-forms.label for="image" value="Image" />
                <x-forms.input type="file" name="image" id="image" />
                <x-forms.input-error for="image" class="mt-2" />
            </div>

            <div class="flex justify-between items-center space-x-6">
                <div class="w-1/2">
                    <x-forms.label for="username" value="Username" />
                    <x-forms.input type="text" name="username" id="username" :value="old('username')" required />
                </div>
                <div class="w-1/2">
                    <x-forms.label for="email" value="Email" />
                    <x-forms.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>
            </div>
            @if($errors->has('username', 'email'))
                <div class="flex justify-between items-center space-x-6">
                    <div class="w-1/2">
                        <x-forms.input-error for="username" class="mt-2" />
                    </div>
                    <div class="w-1/2">
                        <x-forms.input-error for="email" class="mt-2" />
                    </div>
                </div>
            @endif
            <div class="flex justify-between items-center space-x-6">
                <div class="w-1/2">
                    <x-forms.label for="password" value="Password" />
                    <x-forms.input type="password" name="password" id="password" required autocomplete="current-password" />
                </div>
                <div class="w-1/2">
                    <x-forms.label for="password_confirmation" value="Confirm Password" />
                    <x-forms.input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
            </div>
            @if($errors->has('password'))
                <div class="flex justify-between items-center space-x-6">
                    <div class="w-1/2">
                        <x-forms.input-error for="password" class="mt-2" />
                    </div>
                    <div class="w-1/2">
                        <x-forms.input-error for="password_confirmation" class="mt-2" />
                    </div>
                </div>
            @endif
            <div class="flex justify-end space-x-4">
                <x-links.btn-secondary href="{{ url()->previous() }}" class="px-3 py-2 text-xs font-medium">Back</x-links.btn-secondary>
                <x-buttons.primary class="px-3 py-2 text-xs font-medium">Save</x-buttons.primary>
            </div>
        </form>
    </x-cards.default>
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
                    process: '{{ route('admin.filepond.upload') }}',
                    revert: '{{ route('admin.filepond.revert') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            });
        </script>
    @endpush
</x-admin-layout>
