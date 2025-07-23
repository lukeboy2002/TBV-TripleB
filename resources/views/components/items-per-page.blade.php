<div class="flex">
    <div class="flex space-x-4 items-center mb-3">
        <x-form.label>Per page</x-form.label>
        <x-form.select wire:model.live="perPage" class="w-32">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </x-form.select>
    </div>
</div>
