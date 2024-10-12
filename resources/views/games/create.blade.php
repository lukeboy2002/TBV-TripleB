<x-app-layout>
    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    @endpush
    <x-slot name="hero">
        <img src="{{ asset("storage/assets/newgame.png") }}"
             alt="Background Image"
             class="absolute inset-0 w-full h-124 object-cover object-bottom"
        />
        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <h3 class="text-orange-500 font-heading font-semibold tracking-wide text-xl md:text-2xl uppercase">
                Create New Game
            </h3>
            <h1 class="text-5xl font-heading font-black tracking-wider uppercase text-white">
                TBV-TripleB
            </h1>
        </div>
    </x-slot>
        
    <x-card>
        <form action="{{ route('games.store') }}" method="POST">
            @csrf


            <div class="space-y-2 mb-6">
                <x-label for="date">Competition Date</x-label>
                <x-input type="date"
                         name="date"
                         id="date"
                         value="{{ old('date', now()->format('Y-m-d')) }}"
                         required/>
            </div>

            <div class="space-y-2">
                <x-label for="players">Select Players</x-label>
                <div class="flex justify-between text-sm">
                    <select
                            class="js-example-basic-multiple w-full"
                            id="users"
                            name="users[]"
                            data-placeholder="Select users..."
                            data-allow-clear="false"
                            multiple="multiple">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ ucfirst($user->username) }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="flex justify-end mt-4">
                <x-button-primary type="submit">Start</x-button-primary>
            </div>
        </form>
    </x-card>
    <x-slot name="side">
        To be Continued
    </x-slot>

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>

            // SELECT 2
            $(document).ready(function () {
                $('.js-example-basic-multiple').select2();
            });
        </script>
    @endpush
</x-app-layout>