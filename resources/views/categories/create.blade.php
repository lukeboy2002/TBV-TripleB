<x-app-layout title="Nieuwe Categorie">
    <x-slot name="header">
        <x-heading.main>Nieuwe categorie</x-heading.main>
    </x-slot>
    <x-card.default>
        <livewire:categories.create/>
    </x-card.default>
    <x-slot name="side">
        <livewire:category-list/>
    </x-slot>
</x-app-layout>