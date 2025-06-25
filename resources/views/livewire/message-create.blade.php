<!-- resources/views/livewire/message-create.blade.php -->
<div>
    <x-tbv-button_secondary wire:click="toggleModal">
        <x-lucide-message-square-more class="h-4 w-4 mr-2"/>
        <span>Message</span>
    </x-tbv-button_secondary>

    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-background/75" aria-hidden="true"
                     wire:click="toggleModal"></div>

                <!-- Main modal -->
                <div class="flex justify-between items-center h-screen max-w-md mx-auto">
                    <div class="relative bg-background rounded-lg shadow-sm w-full">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-xl font-semibold text-secondary font-secondary">
                                Send Message to {{ $recipient->username }}
                            </h3>
                            <button type="button"
                                    class="end-2.5 text-primary hover:text-secondary text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                    data-modal-hide="authentication-modal" wire:click="toggleModal">
                                <x-lucide-x class="h-5 w-5"/>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <form wire:submit="sendMessage">
                                <div class="mb-4">
                                    <label for="messageContent" class="block mb-2 text-sm font-medium text-primary">Message</label>
                                    <textarea id="messageContent"
                                              wire:model="messageContent"
                                              rows="4"
                                              class="w-full px-3 py-2 text-sm text-primary bg-background border border-border rounded-lg focus:ring-secondary focus:border-secondary"
                                              placeholder="Type your message here..."></textarea>
                                    @error('messageContent') <span
                                            class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div class="flex justify-end">
                                    <x-tbv-button type="submit">
                                        <x-lucide-send class="h-4 w-4 mr-2"/>
                                        <span>Send Message</span>
                                    </x-tbv-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>