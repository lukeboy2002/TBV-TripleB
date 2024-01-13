<x-guest-layout>
    <div class="bg-cover bg-center" style="background-image: url('{{asset('storage/backgrounds/login.jpg')}}')">
        <div class="flex justify-center items-center h-screen">
            <div class="bg-white/75 dark:bg-gray-800/75 mx-4 p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3">
                <h1 class="text-3xl font-bold mb-8 text-center text-orange-500">Login</h1>
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <x-forms.label for="username" value="Username" />
                        <x-forms.input type="text" name="username" id="name" :value="old('username')" required autofocus />
                        <x-forms.input-error for="username" class="mt-2" />
                    </div>
                    <div>
                        <x-forms.label for="password" value="Password" />
                        <x-forms.input type="password" name="password" id="password" required autocomplete="current-password" />
                        <x-forms.input-error for="password" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2">
                            <x-forms.checkbox id="remember_me" name="remember" value="1" />
                            <x-forms.label for="remember_me" value="Remember me" />
                        </div>
                        @if (Route::has('password.request'))
                            <x-links.primary href="{{ route('password.request') }}">Forgot your password?</x-links.primary>
                        @endif
                    </div>
                    <x-buttons.primary class="px-5 py-2.5 text-sm font-medium w-full">Log in</x-buttons.primary>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
