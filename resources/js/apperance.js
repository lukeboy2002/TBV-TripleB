// Function to initialize theme toggle functionality
function initializeThemeToggle() {
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    if (!themeToggleDarkIcon || !themeToggleLightIcon) {
        return; // Exit if elements don't exist
    }

    // Change the icons inside the button based on previous settings
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
    }

    var themeToggleBtn = document.getElementById('theme-toggle');
    if (!themeToggleBtn) return;

    // Remove existing event listener if any (to prevent duplicates)
    themeToggleBtn.replaceWith(themeToggleBtn.cloneNode(true));
    themeToggleBtn = document.getElementById('theme-toggle');

    themeToggleBtn.addEventListener('click', function () {
        // Get fresh references to icons (they might have been replaced)
        var darkIcon = document.getElementById('theme-toggle-dark-icon');
        var lightIcon = document.getElementById('theme-toggle-light-icon');

        // toggle icons inside button
        darkIcon.classList.toggle('hidden');
        lightIcon.classList.toggle('hidden');

        // if set via local storage previously
        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }

            // if NOT set via local storage previously
        } else {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }
    });
}

// Function to apply theme based on localStorage
function applyTheme() {
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

// Initialize on DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    initializeThemeToggle();
});

// Listen for Livewire navigation events
document.addEventListener('livewire:navigating', function() {
    applyTheme();
});

document.addEventListener('livewire:navigated', function() {
    applyTheme();
    initializeThemeToggle();
});
