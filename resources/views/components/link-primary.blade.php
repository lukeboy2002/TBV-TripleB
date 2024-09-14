<a wire:navigate
        {{ $attributes->merge(["class" => "text-orange-500 hover:text-gray-600 focus:outline-none focus:text-gray-600 transition duration-150 ease-in-out" ]) }}
>
    {{ $slot }}
</a>


