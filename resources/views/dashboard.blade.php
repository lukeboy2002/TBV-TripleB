<x-app-layout title="Dashboard">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.default>
                <x-heading.heading1>TEST</x-heading.heading1>
                <div class="text-error text-lg font-bold">ERROR</div>
                <div class="text-edit text-lg font-bold">EDIT</div>
                <div class="text-success text-lg font-bold">SUCCESS</div>
            </x-card.default>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card.default>
                <x-welcome/>
            </x-card.default>
        </div>
    </div>
</x-app-layout>
