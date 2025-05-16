// Initialiseer Flowbite drawer
document.addEventListener('DOMContentLoaded', function () {
    const drawer = {
        id: 'drawer-navigation',
        show: function () {
            const element = document.getElementById(this.id);
            element.classList.remove('-translate-x-full');
        },
        hide: function () {
            const element = document.getElementById(this.id);
            element.classList.add('-translate-x-full');
        }
    };

    // Voeg click handlers toe
    document.querySelectorAll('[data-drawer-toggle="drawer-navigation"]').forEach(trigger => {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            const element = document.getElementById(drawer.id);
            if (element.classList.contains('-translate-x-full')) {
                drawer.show();
            } else {
                drawer.hide();
            }
        });
    });

    // Sluit knop handler
    document.querySelectorAll('[data-drawer-hide="drawer-navigation"]').forEach(trigger => {
        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            drawer.hide();
        });
    });
});