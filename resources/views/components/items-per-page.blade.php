<div class="flex">
    <div class="flex space-x-4 items-center mb-3">
        <x-forms.label class="w-32">Per page</x-forms.label>
        <x-forms.select wire:model.live="perPage">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </x-forms.select>
    </div>
</div>
