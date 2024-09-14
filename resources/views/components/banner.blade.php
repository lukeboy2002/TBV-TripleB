@props(['style' => session('flash.bannerStyle', 'success'), 'message' => session('flash.banner')])

<div x-data="{{ json_encode(['show' => true, 'style' => $style, 'message' => $message]) }}"
     :class="{ 'text-green-500': style == 'success', 'text-red-500': style == 'danger', 'text-yellow-500': style == 'warning', 'text-gray-500': style != 'success' && style != 'danger' && style != 'warning'}"
     style="display: none;"
     x-show="show && message"
     x-on:banner-message.window="
                style = event.detail.style;
                message = event.detail.message;
                show = true;
                setTimeout(() => show = false, 3000)
            ">
    <div class="fixed bottom-10 right-10 w-full max-w-xs rounded-lg border"
         :class="{ 'bg-green-50 border-green-500 text-green-500': style == 'success', 'bg-red-50 border-red-500 text-red-500': style == 'danger', 'bg-yellow-50 border-yellow-500 text-yellow-500': style == 'warning', 'bg-gray-50 border-gray-500 text-gray-500': style != 'success' && style != 'danger' && style != 'warning'}">
        <div class="flex items-center justify-between flex-wrap">
            <div class="w-0 flex-1 flex items-center min-w-0">
                <span class="flex p-2 rounded-lg"
                      :class="{ 'bg-green-50': style == 'success', 'bg-red-70': style == 'danger', 'bg-yellow-50': style == 'warning' }">
                    <x-heroicon-o-check-circle x-show="style == 'success'" class="size-5"/>
                    <x-heroicon-o-exclamation-circle x-show="style == 'danger'" class="size-5"/>
                    <x-heroicon-o-exclamation-triangle x-show="style == 'warning'" class="size-5"/>
                    <x-heroicon-o-question-mark-circle
                            x-show="style != 'success' && style != 'danger' && style != 'warning'" class="size-5"/>
                </span>

                <p class="ms-3 font-medium text-sm text-gray-700 truncate" x-text="message"></p>
            </div>

            <div class="shrink-0 sm:ms-3">
                <button type="button"
                        class="text-gray-700 -me-1 flex rounded-md p-2 transition focus:outline-none"
                        :class="{'text-green-500 hover:text-green-600 focus:text-green-600': style == 'success', 'text-red-500 hover:text-red-600 focus:text-red-600': style == 'danger', 'text-yellow-500 hover:text-yellow-600 focus:text-yellow-600': style == 'warning', 'text-gray-500 hover:text-yellow-600 focus:text-yellow-600': style != 'success' && style != 'danger' && style != 'warning'}"
                        aria-label="Dismiss"
                        x-on:click="show = false">
                    <x-heroicon-o-x-circle class="size-5"/>
                </button>
            </div>
        </div>
    </div>
</div>
