<div id="containerSidebar">
    <div class="relative z-40">
        <nav id="sidebar" class="fixed left-0 bottom-0 flex w-3/5 -translate-x-full flex-col overflow-y-auto bg-white dark:bg-gray-800 pt-6 pb-8 sm:max-w-xs lg:w-80">
            <div class="px-2 pt-2 pb-3 space-y-5">
                <div class="py-2 flex justify-center">
                    <x-main.application-logo />
                </div>
                <div class="pb-4 ml-2">
                    <x-blocks.join-us />
                </div>
                <div class="pb-4 ml-2">
                    <x-blocks.contact />
                </div>
            </div>
            <x-menus.mobile />
            <div class="pt-8">
                <div class="flex justify-center items-center space-x-4 px-2 pb-8">
                    <x-menus.social />
                </div>
            </div>
        </nav>
    </div>
</div>
