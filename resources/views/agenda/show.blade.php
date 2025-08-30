<x-app-layout title="Events">
    <x-slot name="header">
        <x-heading.main>{{ $agenda->name }}</x-heading.main>
    </x-slot>

    <x-card.blog>
        <x-slot name="header">
            <img class="rounded-lg h-[30rem] min-h-full w-full object-cover"
                 src="{{ Storage::url($agenda->image) }}"
                 alt="{{ $agenda->name }}"/>
        </x-slot>
        <div class="px-4">
            <div class="flex justify-between items-center">
                @hasanyrole('admin|member')
                <livewire:agenda.attending-count :agenda="$agenda" wire:key="attending-count-{{ $agenda->id }}"/>
                @endhasanyrole

                <livewire:actions.agenda-actions :agenda="$agenda"/>
            </div>
            <div class="px-4 pt-3">
                <p class="text-sm text-primary-muted">{{ $agenda->getFormattedDateTime() }}</p>
            </div>
            <div class="content text-primary pt-4 px-4">
                {!! $agenda->description !!}
            </div>
        </div>
    </x-card.blog>

    <x-slot name="side">
        <div class="w-full flex flex-col gap-6 md:gap-12">
            @hasanyrole('admin|member')
            <livewire:agenda.attendance :agenda="$agenda" wire:key="attendance-form-{{ $agenda->id }}"/>
            <livewire:agenda.attendance-lists :agenda="$agenda" wire:key="attendance-lists-{{ $agenda->id }}"/>
            @endhasanyrole
        </div>
    </x-slot>
</x-app-layout>