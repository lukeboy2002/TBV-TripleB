<button {{ $attributes->merge(['class' => 'inline-flex justify-center items-center px-4 py-2 bg-error border border-transparent rounded-md font-semibold text-xs text-primary uppercase tracking-widest hover:bg-error/70 focus:bg-error/70 active:bg-error/70 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
