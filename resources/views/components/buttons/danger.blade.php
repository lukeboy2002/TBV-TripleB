<button {{ $attributes->merge(['type' => 'button', 'class' => 'text-white bg-red-700 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
