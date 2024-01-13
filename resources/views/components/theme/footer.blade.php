<footer>
{{--    <div class="max-w-6xl mx-auto py-8 px-4">--}}
{{--        <x-sponsors />--}}
{{--    </div>--}}

    <div class="relative">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="mx-4 w-full border-t border-gray-700"></div>
        </div>
    </div>

    <div class="w-full mx-auto sm:max-w-7xl sm:flex sm:justify-around sm:items-start py-5 md:py-12 md:px-0">
        <!-- LOGO -->
        <div class="flex justify-center">
            <x-theme.logo />
            <div class="pt-4 block lg:text-center lg:flex lg:justify-center lg:items-center">
                <x-links.btn-secondary class="px-3 py-2 text-xs font-medium" href="#">Volg ons</x-links.btn-secondary>

                <div class="block space-x-2 pt-4 lg:pt-0 lg:flex lg:items-center lg:space-x-5 lg:ml-4">
                    <x-menus.social-icons />
                </div>
            </div>
        </div>
        <div class="w-full sm:w-1/4 px-6 pt-10 sm:px-0 sm:pt-0">
            <div class="text-orange-500 font-black pb-3 uppercase">Laatste Nieuws</div>
            <div class="w-1/4 border-b-2 border-orange-500 mb-4"></div>
{{--            <x-post-footer />--}}
        </div>
        <!-- CONTACT -->
        <div class="w-full sm:w-1/4 px-6 pt-10 sm:px-0 sm:pt-0">
            <div class="text-orange-500 font-black pb-3 uppercase">Neem contact op</div>
            <div class="w-1/4 border-b-2 border-orange-500 mb-4"></div>
            <x-theme.contact-us />
        </div>
    </div>

    <div class="max-w-6xl mx-auto md:flex justify-around items-center py-5 px-5 md:px-0">
        <div class="flex justify-center md:justify-around space-x-1 md:space-x-6">
            <x-menus.footer />
        </div>
        <div class="pt-6 text-center md:pt-0">
            <x-links.primary href="#">{{ config('app.name') }} &copy; 2023</x-links.primary>
        </div>
    </div>
</footer>
