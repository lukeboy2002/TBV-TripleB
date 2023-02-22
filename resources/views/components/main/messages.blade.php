@if (session()->has('error'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         class="fixed bg-red-50 text-gray-900 py-2 px-4 rounded-xl top-3 right-3 text-sm"
    >
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="false">>
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-600">
                    Error
                </h3>
                <div class="mt-2 text-sm text-red-600">
                    <p>
                        {{ session('error') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('success'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         class="fixed bg-green-100 text-white py-2 px-4 rounded-xl top-3 right-3 text-sm z-50"
    >
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">
                    Success
                </h3>
                <div class="mt-2 text-sm text-green-700">
                    <p>
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('status'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         class="fixed absolute z-50 bg-green-100 text-white py-2 px-4 rounded-xl top-3 right-3 text-sm"
    >
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">
                    Success
                </h3>
                <div class="mt-2 text-sm text-green-700">
                    <p>
                        {{ session('status') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- End status session -->

@if (session('status') === 'profiles-information-updated')
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         class="fixed bg-green-100 text-white py-2 px-4 rounded-xl top-3 right-3 text-sm z-50"
    >
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">
                    Success
                </h3>
                <div class="mt-2 text-sm text-green-700">
                    <p>
                        profile information updated
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('status') === 'password-updated')
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         class="fixed bg-green-100 text-white py-2 px-4 rounded-xl top-3 right-3 text-sm z-50"
    >
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">
                    Success
                </h3>
                <div class="mt-2 text-sm text-green-700">
                    <p>
                        Password has been updated.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif


{{--@if (session('status') == 'two-factor-authentication-enabled')--}}
{{--    <div x-data="{ show: true }"--}}
{{--         x-init="setTimeout(() => show = false, 4000)"--}}
{{--         x-show="show"--}}
{{--         class="fixed bg-green-100 text-white py-2 px-4 rounded-xl top-3 right-3 text-sm z-50"--}}
{{--    >--}}
{{--        <div class="flex">--}}
{{--            <div class="flex-shrink-0">--}}
{{--                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />--}}
{{--                </svg>--}}
{{--            </div>--}}
{{--            <div class="ml-3">--}}
{{--                <h3 class="text-sm font-medium text-green-800">--}}
{{--                    Success--}}
{{--                </h3>--}}
{{--                <div class="mt-2 text-sm text-green-700">--}}
{{--                    <p>--}}
{{--                        Two factor authentication has been enabled.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}

{{--@if (session('status') == 'two-factor-authentication-disabled')--}}
{{--    <div x-data="{ show: true }"--}}
{{--         x-init="setTimeout(() => show = false, 4000)"--}}
{{--         x-show="show"--}}
{{--         class="fixed bg-green-100 text-white py-2 px-4 rounded-xl top-3 right-3 text-sm z-50"--}}
{{--    >--}}
{{--        <div class="flex">--}}
{{--            <div class="flex-shrink-0">--}}
{{--                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
{{--                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />--}}
{{--                </svg>--}}
{{--            </div>--}}
{{--            <div class="ml-3">--}}
{{--                <h3 class="text-sm font-medium text-green-800">--}}
{{--                    Success--}}
{{--                </h3>--}}
{{--                <div class="mt-2 text-sm text-green-700">--}}
{{--                    <p>--}}
{{--                        Two factor authentication has been disabled.--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}

@if (session()->has('message'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         class="fixed bg-green-100 text-white py-2 px-4 rounded-xl top-3 right-3 text-sm z-50"
    >
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">
                    Success
                </h3>
                <div class="mt-2 text-sm text-green-700">
                    <p>
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Status session -->
@if (session('ErrorLogin'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         class="fixed bg-red-50 text-white py-2 px-4 rounded-xl top-3 right-3 text-sm max-w-xs"
    >
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="false">>
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-600">
                    Error
                </h3>
                <div class="mt-2 text-sm text-red-600">
                    <p>
                        {{ session('ErrorLogin') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- End status session -->
