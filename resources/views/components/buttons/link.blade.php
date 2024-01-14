<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-xs font-bold text-gray-900 dark:text-white hover:text-orange-500 dark:hover:text-orange-500 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
