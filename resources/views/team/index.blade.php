<x-app-layout>
    <x-slot name="hero">
        <img src="{{ asset("storage/assets/team.jpg") }}"
             alt="Background Image"
             class="absolute inset-0 w-full h-124 object-cover object-bottom"
        />
        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <h3 class="text-orange-500 font-heading font-semibold tracking-wide text-xl md:text-2xl uppercase">
                Team
            </h3>
            <h1 class="text-5xl font-heading font-black tracking-wider uppercase text-white">
                TBV-TripleB
            </h1>
        </div>
    </x-slot>
    <livewire:team/>
    <x-slot name="side">
        <x-scorelist/>
    </x-slot>
</x-app-layout>