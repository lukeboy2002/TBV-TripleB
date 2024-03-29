<nav class="max-w-6xl flex flex-wrap items-center justify-between mx-auto pt-4 pr-4 md:pt-0">
    <div class="block md:hidden"></div>
    <div class="flex items-center md:order-2 space-x-4 rtl:space-x-reverse">
        <x-dropdowns.user />
        <x-dark-light-mode />
        <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-900 dark:text-white rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
            </svg>
        </button>
    </div>
    <div class="items-center justify-between p-4 md:p-0 hidden w-full md:flex md:w-auto md:order-1 pt-3" id="navbar-user">
        <x-menus.main />
    </div>
</nav>
