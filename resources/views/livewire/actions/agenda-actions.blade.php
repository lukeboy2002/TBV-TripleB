<div>
    <div class="flex items-center gap-2 mr-2">
        @can('update', $agenda)
            <x-link.icon href="{{ route('agenda.edit', $agenda->slug) }}" icon="edit" class="text-edit"/>
        @endcan

        @can('delete', $agenda)
            <x-button.icon wire:click="toggleModal" icon="trash" class="text-error"/>
        @endcan
    </div>
    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
             role="dialog"
             aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-background/75" aria-hidden="true"
                     wire:click="toggleModal"></div>

                <!-- Main modal -->
                <div class="flex justify-between items-center h-screen max-w-md mx-auto">
                    <div class="bg-background border border-secondary/30 relative rounded-lg shadow-sm w-full">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-secondary/30">
                            <h3 class="text-xl font-semibold text-secondary font-secondary">
                                Delete Event
                            </h3>
                            <x-button.icon type="button"
                                           class="text-secondary"
                                           icon="x"
                                           wire:click="toggleModal"
                                           data-modal-hide="authentication-modal"/>
                            <span class="sr-only">Close modal</span>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <div class="flex justify-center mb-4 text-error" aria-hidden="true">
                                <x-lucide-circle-alert class="h-12 w-12"/>
                            </div>
                            <h3 class="mb-5 text-lg font-normal text-primary-muted">Are you sure you
                                want to delete this event</h3>
                            <x-button.default wire:click.prevent="deleteAgenda" type="button">
                                Yes, I'm sure
                            </x-button.default>
                            <x-button.secondary wire:click="toggleModal" type="button">
                                No, cancel
                            </x-button.secondary>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
