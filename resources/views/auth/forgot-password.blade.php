<x-guest-layout>
    <x-messages />
    <div class="bg-cover bg-center" style="background-image: url('{{asset('storage/backgrounds/login.jpg')}}')">
        <div class="flex justify-center items-center h-screen">
            <div class="bg-white/75 dark:bg-gray-800/75 mx-4 p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3">
                <h1 class="text-3xl font-bold mb-8 text-center text-orange-500">Forgot my password</h1>
                <div class="mb-4 text-sm text-gray-700 dark:text-white">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </div>
                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf
                    <div>
                        <x-forms.label for="email" value="Email" />
                        <x-forms.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-forms.input-error for="email" class="mt-2" />
                    </div>
                    <x-buttons.primary class="px-5 py-2.5 text-sm font-medium w-full">Email Password Reset Link</x-buttons.primary>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
