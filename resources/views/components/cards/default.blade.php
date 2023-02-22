<div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

    <div class="border-l-4 border-orange-500 pl-4 flex justify-between items-center">
        <div class="mb-2 text-2xl font-bold text-orange-500">
            {{ $title }}
        </div>
    </div>
    <hr class="h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
    <div class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">
        {{ $slot }}
    </div>
</div>
