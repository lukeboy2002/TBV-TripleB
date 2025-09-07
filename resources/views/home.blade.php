<x-app-layout title="Home">
    <x-slot name="hero">
        <div class="relative w-full">
            <img src="{{ asset('storage/assets/members.jpg' )}}" class="block w-full object-center object-cover"
                 alt="team"/>
        </div>
    </x-slot>

    <div class="mb-6">
        <x-heading.main>TBV-TripleB</x-heading.main>
        <div class="content text-primary">
            <section class="py-6">
                <p class="mb-4 text-lg">
                    Wij zijn een gezellige club van <strong>14 mannen</strong> die af en toe bij elkaar komt voor ons
                    eigen biljartspelletje.
                    Vergeet driebanden of ingewikkelde regels – bij ons draait het om <span class="font-semibold">dubbeltjes</span>,
                    een <span class="font-semibold">schaal in het midden</span> en natuurlijk een flinke dosis lol. 😄
                </p>

                <x-heading.sub>Het spel in het kort</x-heading.sub>
                <x-card.default>
                    <div class="text-left space-y-2">
                        <div>🎱 Iedereen begint met <strong>5 dubbeltjes</strong>.</div>
                        <div>🎱 In het midden van het biljart staat een schaal.</div>
                        <div>🎱 Je speelt met een witte bal en moet de rode raken.</div>
                        <div>🎱 Mis je de rode óf raak je de schaal → dubbeltje in de schaal!</div>
                    </div>
                </x-card.default>

                <div class="bg-background-hover rounded-lg shadow p-6 my-6">
                    <h3 class="text-2xl font-semibold font-secondary mb-4">🏆 De spanning stijgt…</h3>
                    <p class="mb-2">
                        De eerste die van z’n dubbeltjes af is, wint onze <strong>felbegeerde beker</strong>.
                    </p>
                    <p>
                        De allerlaatste die nog overblijft? Die wint de pot 💰 (en meestal ook de grappen van de rest).
                    </p>
                </div>

                <p class="text-lg">
                    Bij ons gaat het niet alleen om winnen of verliezen, maar vooral om de
                    <span class="font-semibold">gezelligheid</span>, de plagerijtjes en de sterke verhalen die
                    ongetwijfeld volgen.
                    Kortom: <span class="italic">biljart, bier en veel plezier!</span> 🍻
                </p>
            </section>
        </div>

    </div>
    <div>
        @if(!$featuredPosts->isEmpty())
            <div class="mb-6">
                <x-heading.sub>In de spotlights</x-heading.sub>
                <x-card.default>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-8">
                        @foreach($featuredPosts as $post)
                            <x-card.blog-featured :post="$post"/>
                        @endforeach
                    </div>
                </x-card.default>
            </div>
        @endif
        @if(!$latestPosts->isEmpty())
            <div>
                <x-heading.sub>Laatste berichten</x-heading.sub>
                <x-card.default>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-8">
                        @foreach($latestPosts as $post)
                            <x-card.blog-featured :post="$post"/>
                        @endforeach
                    </div>
                </x-card.default>
            </div>
        @endif
    </div>

    <x-slot name="side">
        <div class="w-full flex flex-col gap-6 md:gap-12">
            <livewire:agenda.upcoming/>
            <livewire:games.cup-winner/>
            <livewire:games.latest-game/>
            <livewire:albums.latest-album-image/>
        </div>

    </x-slot>
</x-app-layout>