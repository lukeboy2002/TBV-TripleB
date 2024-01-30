<button {{ $attributes->merge(['type' => 'submit', 'class' => 'flex items-center text-center text-gray-700 dark:text-white rounded-lg hover:bg-orange-500 hover:text-white border border-orange-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 focus:bg-orange-500 transition ease-in-out duration-150']) }}>
    {{ $slot }}
    <x-icons name="x-mark" />
</button>
