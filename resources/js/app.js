import './bootstrap';
import { initFlowbite } from 'flowbite';
import './apperance';

// Helper to clean up any leftover Flowbite drawer backdrops and reset drawer state
function cleanupDrawerArtifacts() {
    try {
        // Remove any Flowbite drawer backdrops that might block clicks
        document.querySelectorAll('[drawer-backdrop], .drawer-backdrop').forEach(el => el.remove());
        // Ensure body scroll is restored (Flowbite may add overflow-hidden)
        document.body.classList.remove('overflow-hidden');
        // Force-close the drawer (ensure it's translated off-screen)
        const drawer = document.getElementById('drawer-navigation');
        if (drawer) {
            drawer.classList.add('-translate-x-full');
            drawer.classList.remove('translate-x-0');
            drawer.setAttribute('aria-hidden', 'true');
        }
    } catch (e) {
        // no-op
    }
}

// Delegate to auto-close drawer when any link inside it is clicked
function bindDrawerLinkAutoClose() {
    const drawer = document.getElementById('drawer-navigation');
    if (!drawer || drawer.dataset.autoCloseBound === 'true') return;

    drawer.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        if (!link) return;
        // Trigger the built-in close button to ensure Flowbite updates state
        const closeBtn = drawer.querySelector('[data-drawer-hide="drawer-navigation"]');
        if (closeBtn) {
            closeBtn.click();
        }
        // Clean up any potential artifacts ASAP
        setTimeout(() => cleanupDrawerArtifacts(), 0);
    });

    drawer.dataset.autoCloseBound = 'true';
}

document.addEventListener('DOMContentLoaded', () => {
    // Ensure Flowbite components are initialized on full page reload
    cleanupDrawerArtifacts();
    initFlowbite();
    bindDrawerLinkAutoClose();
});

// Before Livewire navigates, clean up any artifacts from an open drawer
document.addEventListener('livewire:navigating', () => {
    cleanupDrawerArtifacts();
});

document.addEventListener('livewire:navigated', () => {
    // Re-initialize after Livewire navigations
    cleanupDrawerArtifacts();
    initFlowbite();
    bindDrawerLinkAutoClose();
});