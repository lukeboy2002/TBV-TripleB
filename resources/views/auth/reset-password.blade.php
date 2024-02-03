<x-guest-layout>
    <div class="bg-cover bg-center" style="background-image: url('{{asset('storage/backgrounds/register.jpg')}}')">
        <div class="flex justify-center items-center h-screen">
            <div class="bg-white/75 dark:bg-gray-800/75 mx-4 p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3">
                <h1 class="text-3xl font-bold mb-8 text-center text-orange-500">Change password</h1>
                <div class="mb-4 text-sm text-gray-700 dark:text-white">
                    Create a new password for your account.
                </div>
                <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div>
                        <x-forms.label for="email" value="Email" />
                        <x-forms.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-forms.input-error for="email" class="mt-2" />
                    </div>
                    <div>
                        <x-forms.label for="password" value="Password" />
                        <x-forms.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-forms.input-error for="password" class="mt-2" />
                    </div>
                    <div>
                        <x-forms.label for="password_confirmation" value="Confirm Password" />
                        <x-forms.input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-forms.input-error for="password_confirmation" class="mt-2" />
                    </div>
                    <div>
                        <x-buttons.primary class="px-5 py-2.5 text-sm font-medium w-full">Reset Password</x-buttons.primary>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
