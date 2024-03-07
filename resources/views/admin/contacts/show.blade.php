<x-admin-layout>
    <x-slot name="header">
        Reply Message
    </x-slot>

    <x-cards.default>
        <table class="text-sm text-left rtl:text-right text-gray-700 dark:text-white">
            <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    From
                </th>
                <td class="px-6 py-2 w-full">
                    <div class="border rounded-lg order-gray-300 dark:border-gray-500 block w-full p-2">
                        {{ $contact->name }}
                    </div>
                </td>
            </tr>
            <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    Subject
                </th>
                <td class="px-6 py-2 w-full">
                    <div class="border rounded-lg order-gray-300 dark:border-gray-500 block w-full p-2">
                        {{ $contact->subject }}
                    </div>
                </td>
            </tr>
            <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white align-top">
                    Message
                </th>
                <td class="px-6 py-2 w-full">
                    <div class="border rounded-lg order-gray-300 dark:border-gray-500 block w-full p-2 prose dark:prose-invert">
                        {!! $contact->message !!}
                    </div>
                </td>
            </tr>
        </table>
    </x-cards.default>

    <x-theme.heading class="my-6">Reply</x-theme.heading>
    <x-cards.default>
        <form method="POST" action="{{ route('admin.contact.store') }}" class="space-y-6">
        @csrf
            <div class="flex justify-between items-center gap-x-4">
                <div class="w-1/2">
                    <x-forms.label for="username" value="Name" />
                    <x-forms.input type="text" name="name" id="name" value="{{ $contact->name }}" readonly />
                    <x-forms.input-error for="name" class="mt-2" />
                </div>
                <div class="w-1/2">
                    <x-forms.label for="email" value="Email" />
                    <x-forms.input type="email" name="email" id="email" value="{{ $contact->email }}" readonly />
                    <x-forms.input-error for="email" class="mt-2" />
                </div>
            </div>
            <div>
                <x-forms.label for="subject" value="Subject" />
                <x-forms.input type="text" name="subject" id="subject" value="Re: {{ $contact->subject }}" readonly />
                <x-forms.input-error for="subject" class="mt-2" />
            </div>
            <div>
                <x-forms.label for="message" value="Message" />
                <x-forms.textarea id="message" name="message"></x-forms.textarea>
                <x-forms.input-error for="message" class="mt-2" />
            </div>
                <x-forms.input type="hidden" name="id" id="id" value="{{ $contact->id }}" readonly />
            <div class="flex justify-end">
                <x-buttons.primary type="submit" class="px-3 py-2 text-xs font-medium">
                    Submit
                </x-buttons.primary>
            </div>
        </form>
    </x-cards.default>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#message'), {
                    removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'],
                })

                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-admin-layout>