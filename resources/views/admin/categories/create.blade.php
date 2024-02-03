<x-admin-layout>
    <x-slot name="header">
        Invitations
    </x-slot>

    <x-cards.default>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="flex justify-between items-center space-x-4">
                <div class="w-1/2">
                    <x-forms.label for="title" value="Category title" />
                    <x-forms.input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required />
                    <x-forms.input-error for="title" class="mt-2" />
                </div>
                <div class="w-1/2">
                    <x-forms.label for="color" value="Category color" />
                    <x-forms.select name="color" id="color">
                        <option value="orange">Orange</option>
                        <option value="blue">Blue</option>
                        <option value="gray">Gray</option>
                        <option value="red">Red</option>
                        <option value="green">Green</option>
                        <option value="yellow">Yellow</option>
                        <option value="indigo">Indigo</option>
                        <option value="purple">Purple</option>
                        <option value="pink">Pink</option>
                    </x-forms.select>
                    <x-forms.input-error for="color" class="mt-2" />
                </div>
            </div>

            <div class="flex justify-end items-center pt-6">
                <div class="bg-orange-100 text-orange-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">Orange</div>
                <div class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Blue</div>
                <div class="bg-gray-100 text-gray-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Dark</div>
                <div class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Red</div>
                <div class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Green</div>
                <div class="bg-yellow-100 text-yellow-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Yellow</div>
                <div class="bg-indigo-100 text-indigo-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-indigo-900 dark:text-indigo-300">Indigo</div>
                <div class="bg-purple-100 text-purple-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Purple</div>
                <div class="bg-pink-100 text-pink-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-pink-900 dark:text-pink-300">Pink</div>
            </div>

            <div class="flex justify-end pt-6">
                <x-buttons.primary class="px-3 py-2 text-xs font-medium">Save</x-buttons.primary>
            </div>
        </form>
    </x-cards.default>

    <x-cards.default class="mt-4">
{{--        <livewire:admin.invitations-table />--}}
    </x-cards.default>
</x-admin-layout>
