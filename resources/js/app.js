import './bootstrap';
import 'flowbite';
import './apperance';

document.addEventListener("livewire:navigated", () => {
    window.Flowbite?.initDrawers();
});