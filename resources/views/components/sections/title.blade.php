<div class="md:col-span-1 flex justify-between">
    <div class="px-4 sm:px-0">
        <div class="border-l-4 border-orange-500 pl-4 flex justify-between items-center">
            <h3 class="text-lg font-bold text-orange-500">{{ $title }}</h3>
        </div>

        <p class="ml-5 mt-1 text-sm text-gray-700 dark:text-white">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
