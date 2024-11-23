<footer class="bg-menu/90">
    <div class="max-w-7xl mx-auto">
        <div class="min-h-44 px-4 flex flex-col md:gap-x-4 sm:flex-row sm:justify-between items-center md:items-start py-10"
        ">
        <div class="flex flex-col items-center py-4 space-y-3 md:w-1/3 lg:w-1/5 ">
            <div class="flex items-center flex-col">
                <div class="text-xl font-black text-primary tracking-widest">
                    TBV-TripleB
                </div>
                <div class="text-xs text-light/60">{{ __('We love a game of billiards') }}</div>
            </div>
            <div class="flex flex-col items-center space-y-2">
                <x-application-logo/>
                <div>
                    <x-IconsSocial/>
                </div>
            </div>

        </div>
        <div class="hidden md:w-1/3 lg:w-3/5 md:block md:mt-4 md:max-w-7xl">
            <div class="text-xl font-black text-primary font-heading tracking-widest pb-4">
                OUR BLOG
            </div>
            <div class="flex justify-between gap-4 pb-4">
                <div class="hidden md:w-full md:inline-flex lg:hidden">
                    @foreach(range(1,1) as $index)
                        <div class="w-full">
                            <div class="flex gap-4">
                                <img src="{{ asset("storage/assets/r2d2.png") }}"
                                     alt="image"
                                     class="max-h-32 w-full rounded-tl-lg object-top object-cover"
                                />
                                <div>
                                    <h3 class="text-primary font-bold text-xl">title</h3>
                                    <p class="text-md text-light">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam bibendum dolor
                                        odio, et tristique sem dignissim a. Sed congue ex..
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="hidden lg:w-full lg:inline-flex gap-x-4">
                    @foreach(range(1,2) as $index)
                        <div class="w-full">
                            <div class="flex gap-4">
                                <img src="{{ asset("storage/assets/r2d2.png") }}"
                                     alt="image"
                                     class="max-h-32 w-full rounded-tl-lg object-top object-cover"
                                />
                                <div>
                                    <h3 class="text-primary font-bold text-xl">title</h3>
                                    <p class="text-md text-light">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam bibendum dolor
                                        odio, et tristique sem dignissim a. Sed congue ex..
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="md:w-1/3 lg:w-1/5 md:min-h-44 md:flex pb-8 md:pb-0">
            <x-contact-us/>
        </div>
    </div>

    <div class="flex justify-center items-center text-sm text-light h-16 border-t border-primary/30 ">
        TBV-TripleB (c) 2024 All rights reserved
    </div>
    </div>

</footer>