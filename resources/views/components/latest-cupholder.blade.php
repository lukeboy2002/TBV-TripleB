<div>
    @forelse($games as $game)
        <x-heading>Last cup winner</x-heading>

        <div class="max-w-xs bg-white border border-gray-200 rounded-lg shadow">
            <a href="#">
                <img class="rounded-t-lg" src="{{ asset('storage/' . $game->image) }}" alt=""/>
            </a>
            <div class="p-5 text-center bg-gray-100">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-orange-500">
                        {{ ucfirst($game->cupWinner->username) }}
                    </h5>
                </a>
            </div>
        </div>
    @empty
        <div></div>
    @endforelse
</div>