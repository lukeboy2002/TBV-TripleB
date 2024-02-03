<x-admin-layout>
    <x-slot name="header">
        New Permission
    </x-slot>

    <x-cards.default>
        <form method="POST" action="{{ route('admin.roles.store') }}" class="space-y-6">
            @csrf
            <div>
                <x-forms.label for="name" value="Name" />
                <x-forms.input type="text" name="name" id="name" :value="old('name')" required autofocus />
                <x-forms.input-error for="name" class="mt-2" />
            </div>
            <div class="flex justify-end space-x-2">
                <x-buttons.secondary type="button" onclick="history.back()" class="px-3 py-2 text-xs font-medium">Cancel</x-buttons.secondary>
                <x-buttons.primary class="px-3 py-2 text-xs font-medium">Save</x-buttons.primary>
            </div>
        </form>
    </x-cards.default>
</x-admin-layout>
