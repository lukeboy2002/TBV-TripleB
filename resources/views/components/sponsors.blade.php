<div>
    <p class="lg:hidden block mb-4 w-full text-center text-gray-900 dark:text-white font-black">
        Onze Sponsoren
    </p>

    <ul role="list" class="grid grid-cols-3 gap-4 sm:grid-cols-5 lg:grid-cols-6">
        <li class="relative hidden lg:block">
            <p class="w-full text-center text-gray-900 dark:text-white font-black">
                Onze Sponsoren
            </p>
        </li>
        @foreach ($sponsors as $sponsor)
            <li class="relative">
                <a href="{{ $sponsor->link }}" target="_blank">
                    <div class="group aspect-w-10 aspect-h-7 block w-full overflow-hidden rounded-lg bg-gray-900 focus-within:ring-2 focus-within:ring-orange-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                        <img src="{{ asset('storage/' . $sponsor->image) }}" alt="{{ $sponsor->name }}" class="pointer-events-none object-fit group-hover:opacity-75" >
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</div>
