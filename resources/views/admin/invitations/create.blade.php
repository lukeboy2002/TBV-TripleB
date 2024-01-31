<x-admin-layout>
    <x-slot name="header">
        Invitations
    </x-slot>

    <x-cards.default>
        <form action="{{ route('admin.invitations.store') }}" method="POST">
            @csrf
            <div>
                <x-forms.label for="email" value="Email" />
                <x-forms.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                <x-forms.input-error for="email" class="mt-2" />
            </div>
            <div class="flex justify-end pt-6">
                <x-buttons.primary class="px-3 py-2 text-xs font-medium">Save</x-buttons.primary>
            </div>
        </form>
    </x-cards.default>

    <x-cards.default class="mt-4">
{{--        <livewire:admin.invitations.all />--}}
    </x-cards.default>
</x-admin-layout>
