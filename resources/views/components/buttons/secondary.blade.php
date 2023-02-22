<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-gray-700 bg-white rounded-lg border border-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 hover:text-orange-500 dark:hover:text-white dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-gray-200 dark:focus:ring-gray-700 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
