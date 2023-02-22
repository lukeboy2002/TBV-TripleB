<x-app-layout>
    <x-cards.small>

        <div class="mb-4 text-sm text-gray-700 dark:text-white">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <x-main.messages />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-form.label for="email" value="Email" />
                <x-form.input type="email" name="email" id="email" :value="old('email')" required autofocus />
                <x-form.input-error for="email" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-buttons.primair class="px-5 py-2.5 text-sm font-medium">
                    Email Password Reset Link
                </x-buttons.primair>
            </div>
        </form>
    </x-cards.small>
</x-app-layout>
