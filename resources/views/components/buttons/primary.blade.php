<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-orange-500 rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-600 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
