import './bootstrap';
import {initFlowbite} from 'flowbite';
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

function initCkeditorIfPresent() {
    const el = document.querySelector('#description');
    if (!el || typeof window.ClassicEditor === 'undefined') return;

    // Determine upload URL from data attribute or meta tag
    const uploadUrl = el.dataset.uploadUrl || (document.querySelector('meta[name="agenda-upload-url"]')?.getAttribute('content')) || '';
    // CSRF token from meta tag (standard in Laravel layouts)
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    window.ClassicEditor
        .create(el)
        .then(editor => {
            if (uploadUrl) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => new MyUploadAdapter(loader, uploadUrl, csrfToken);
            }
        })
        .catch(error => {
            console.error('CKEditor init error:', error);
        });
}

class MyUploadAdapter {
    constructor(loader, uploadUrl, csrfToken) {
        this.loader = loader;
        this.uploadUrl = uploadUrl;
        this.csrfToken = csrfToken;
    }

    upload() {
        return this.loader.file.then(file => new Promise((resolve, reject) => {
            const data = new FormData();
            data.append('upload', file);

            fetch(this.uploadUrl, {
                method: 'POST',
                headers: this.csrfToken ? { 'X-CSRF-TOKEN': this.csrfToken } : undefined,
                body: data
            })
                .then(response => response.json())
                .then(result => {
                    if (result?.uploaded && result?.url) {
                        resolve({ default: result.url });
                    } else if (result?.url) {
                        // Some backends just return the URL
                        resolve({ default: result.url });
                    } else {
                        reject(result?.error?.message || 'Upload failed');
                    }
                })
                .catch(error => reject(error));
        }));
    }

    abort() {}
}

// Hook CKEditor init to lifecycle events
document.addEventListener('DOMContentLoaded', initCkeditorIfPresent);
document.addEventListener('livewire:navigated', initCkeditorIfPresent);