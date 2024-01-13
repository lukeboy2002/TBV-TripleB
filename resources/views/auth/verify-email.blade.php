<x-guest-layout>
    <div class="bg-cover bg-center" style="background-image: url('{{asset('storage/backgrounds/register.jpg')}}')">
        <div class="flex justify-center items-center h-screen">
            <div class="bg-white/75 dark:bg-gray-800/75 mx-4 p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3">
                <div class="mb-4 text-sm text-gray-700 dark:text-white">
                    Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                </div>
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm text-green-600">
                        A new verification link has been sent to the email address you provided in your profile settings.
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}" class="space-y-6">
                    @csrf
                    <x-buttons.primary class="px-3 py-2 text-xs font-medium" type="submit">
                        Resend Verification Email
                    </x-buttons.primary>
                </form>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <x-buttons.primary type="submit" class="px-3 py-2 text-xs font-medium">
                        Log Out
                    </x-buttons.primary>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
