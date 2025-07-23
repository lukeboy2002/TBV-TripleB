<button {{ $attributes->merge(['class' => 'inline-flex justify-center items-center px-4 py-2 bg-transparent border border-secondary/30 rounded-md font-semibold text-xs text-primary uppercase tracking-widest hover:bg-background-hover hover:border-secondary focus:outline-none focus:bg-background-hover focus:border-secondary transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
