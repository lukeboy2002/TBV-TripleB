<x-app-layout title="Forbidden">
    <div class="min-h-[calc(100vh-20rem)] flex items-center justify-center">
        <div class="w-full md:h-96 max-w-4xl md:flex md:justify-between bg-background border border-border rounded-lg shadow-sm">
            <div class="hidden md:block md:w-1/2 inset-0 overflow-hidden">
                <img class="h-full object-cover rounded-l-lg" src="{{asset('storage/assets/register.jpg')}}" alt="">
            </div>
            <div class="flex flex-col items-center justify-center w-full md:w-1/2 gap-6 p-16">
                <div class="font-secondary font-black text-secondary text-4xl">403</div>
                <div>You do not have access to this page.</div>
            </div>
        </div>
    </div>
</x-app-layout>
