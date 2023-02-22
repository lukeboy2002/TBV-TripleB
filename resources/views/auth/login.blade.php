<x-app-layout>
    <div class="flex min-h-full pt-4 sm:pt-0 mb-20">
        <div class="relative hidden w-0 flex-1 sm:block">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{asset('storage/backgrounds/login.jpeg')}}" alt="Background Inlog">
        </div>

        <div class="flex flex-1 flex-col justify-center px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 lg:my-14">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <x-main.application-logo />
                    <h2 class="mt-6 text-3xl font-bold tracking-tight text-orange-500">Sign in to your account</h2>
                </div>
                <div class="mt-8 mb-24">
                    <form method="POST" action="{{ route('login') }} " class="space-y-6">
                        @csrf
                        <div>
                            <x-form.label for="username" value="Username" />
                            <x-form.input type="text" name="username" id="username" :value="old('username')" required autofocus />
                            <x-form.input-error for="username" class="mt-2" />
                        </div>
                        <div>
                            <x-form.label for="password" value="Password" />
                            <x-form.input type="password" name="password" id="password" required autocomplete="current-password" />
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-2">
                                <x-form.checkbox id="remember_me" name="remember" value="1" />
                                <x-form.label for="remember_me" value="Remember me" />
                            </div>
                            @if (Route::has('password.request'))
                                <x-links.primair href="{{ route('password.request') }}">Forgot your password?</x-links.primair>
                            @endif
                        </div>
                        <x-buttons.primair class="px-5 py-2.5 text-sm font-medium w-full">Log in</x-buttons.primair>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
