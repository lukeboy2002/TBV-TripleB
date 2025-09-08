import './bootstrap';
import 'flowbite';
import './apperance';

document.addEventListener('DOMContentLoaded', () => {
    // Ensure Flowbite drawers are initialized on full page reload
    window.Flowbite?.initDrawers?.();
});

document.addEventListener("livewire:navigated", () => {
    // Re-initialize after Livewire navigations
    window.Flowbite?.initDrawers?.();
});