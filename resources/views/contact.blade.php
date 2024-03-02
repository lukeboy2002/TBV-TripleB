<x-app-layout>
    <x-cards.default>
        <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
            @csrf
            <div class="flex justify-between items-center gap-x-4">
                <div class="w-1/2">
                    <x-forms.label for="username" value="Name" />
                    <x-forms.input type="text" name="name" id="name" :value="old('name')" required autofocus />
                    <x-forms.input-error for="name" class="mt-2" />
                </div>
                <div class="w-1/2">
                    <x-forms.label for="email" value="Email" />
                    <x-forms.input type="email" name="email" id="email" :value="old('email')" required />
                    <x-forms.input-error for="email" class="mt-2" />
                </div>
            </div>
            <div>
                <x-forms.label for="subject" value="Subject" />
                <x-forms.input type="text" name="subject" id="subject" :value="old('subject')" required />
                <x-forms.input-error for="subject" class="mt-2" />
            </div>
            <div>
                <label for="message"></label>
                <textarea x-ref="input"
                          id="message"
                          name="message"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                          rows = 7
                          placeholder="Message"
                          required
                ></textarea>
                <x-forms.input-error for="message" class="mt-2" />
            </div>
            <div class="flex justify-end">
                <x-buttons.primary class="px-3 py-2 text-xs font-medium">
                    Submit
                </x-buttons.primary>
            </div>
        </form>
    </x-cards.default>
    <x-slot name="side">
        <img src="{{asset('storage/backgrounds/contact.jpeg')}}" alt="" class="h-full object-cover object-fill border-2 border-orange-500 rounded-lg">
    </x-slot>
</x-app-layout>