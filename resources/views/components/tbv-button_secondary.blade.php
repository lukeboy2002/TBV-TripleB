<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-button-secondary border border-transparent rounded-md font-semibold text-xs text-primary uppercase tracking-widest hover:border-border/30 focus:border-border/30 active:border-border/30 focus:outline-none focus:ring-2 focus:ring-secondary focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
