document.addEventListener('livewire:initialized', () => {
    Livewire.on('appearance-changed', ({appearance}) => {
        if (appearance === 'system') {
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            document.documentElement.classList.toggle('dark', prefersDark);
        } else {
            document.documentElement.classList.toggle('dark', appearance === 'dark');
        }
    });
});