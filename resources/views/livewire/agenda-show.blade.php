<div>
    <x-tbv-heading_h3>{{ $agenda->name }} - <span
                class="text-primary-muted">{{ $agenda->date->format('j F Y') }}</span></x-tbv-heading_h3>

    <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8 bg-background/80 rounded-lg">

        <div class="px-4 py-5 sm:px-6 flex justify-end items-center">

            <div class="flex space-x-3">
                <x-tbv-link-btn href="{{ route('agenda.index') }}">
                    Back
                </x-tbv-link-btn>

                @can('delete', $agenda)
                    <x-tbv-button-danger wire:click="toggleModal">
                        Delete
                    </x-tbv-button-danger>
                @endcan
            </div>
        </div>

        <div class="border-t border-border">
            <dl>
                @if($agenda->image_path)
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-primary-muted">Image</dt>
                        <dd class="mt-1 text-sm text-primary sm:mt-0 sm:col-span-2">
                            <img src="{{ Storage::url($agenda->image_path) }}" alt="{{ $agenda->name }}"
                                 class="h-48 w-auto object-cover rounded">
                        </dd>
                    </div>
                @endif

                @if($agenda->description)
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-primary-muted">Description</dt>
                        <dd class="mt-1 text-sm text-primary sm:mt-0 sm:col-span-2">{{ $agenda->description }}</dd>
                    </div>
                @endif

                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-primary-muted">Created by</dt>
                    <dd class="mt-1 text-sm text-primary sm:mt-0 sm:col-span-2">{{ ucfirst($agenda->user->username) }}</dd>
                </div>

                @hasanyrole('admin|member')
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-primary-muted">Your attendance</dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <form wire:submit="updateAttendance">
                            <div class="flex items-center space-x-4">
                                <select wire:model="attendanceStatus"
                                        class="block w-full pl-3 pr-10 py-2 bg-input border-border text-primary focus:border-border focus:ring-ring rounded-md shadow-xs">
                                    <option value="attending">Attending</option>
                                    <option value="not_attending">Not Attending</option>
                                    <option value="maybe">Maybe</option>
                                </select>

                                <x-tbv-button type="submit"
                                              class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Update
                                </x-tbv-button>
                            </div>
                        </form>
                    </dd>
                </div>
                @endhasanyrole
            </dl>
        </div>
    </div>
    <x-slot name="side">
        <div class="flex flex-col gap-4">
            <div>
                <div class="px-2 rounded-t-lg bg-background">
                    <x-tbv-heading_h5>Present</x-tbv-heading_h5>
                </div>
                <div class="bg-background-accent rounded-b-lg">
                    @forelse($attendances->where('status', 'attending') as $attendance)
                        <div class="flex items-center gap-4 p-2">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full"
                                     src="{{ $attendance->user->profile_photo_url }}"
                                     alt="{{ $attendance->user->username }}">
                            </div>
                            <div class="text-sm font-medium text-secondary">{{ ucfirst($attendance->user->username) }}</div>
                        </div>
                    @empty
                        <div class="p-2 text-secondary">
                            No attendees yet.
                        </div>
                    @endforelse
                </div>
            </div>

            @if($attendances->where('status', 'maybe')->count() > 0)
                <div>
                    <div class="px-2 rounded-t-lg bg-background">
                        <x-tbv-heading_h5>Maybe</x-tbv-heading_h5>
                    </div>
                    <div class="bg-background-accent rounded-b-lg">
                        @foreach($attendances->where('status', 'maybe') as $attendance)
                            <div class="flex items-center gap-4 p-2">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full"
                                         src="{{ $attendance->user->profile_photo_url }}"
                                         alt="{{ $attendance->user->username }}">
                                </div>
                                <div class="text-sm font-medium text-secondary">{{ ucfirst($attendance->user->username) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($attendances->where('status', 'not_attending')->count() > 0)
                <div>
                    <div class="px-2 rounded-t-lg bg-background">
                        <x-tbv-heading_h5>Not Present</x-tbv-heading_h5>
                    </div>
                    <div class="bg-background-accent rounded-b-lg">
                        @foreach($attendances->where('status', 'not_attending') as $attendance)
                            <div class="flex items-center gap-4 p-2">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full"
                                         src="{{ $attendance->user->profile_photo_url }}"
                                         alt="{{ $attendance->user->username }}">
                                </div>
                                <div class="text-sm font-medium text-secondary">{{ ucfirst($attendance->user->username) }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </x-slot>

    @if($showModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
             aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-background/75" aria-hidden="true"
                     wire:click="toggleModal"></div>

                <!-- Main modal -->
                <div class="flex justify-between items-center h-screen max-w-md mx-auto">
                    <div class="relative bg-background rounded-lg shadow-sm w-full">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                            <h3 class="text-xl font-semibold text-secondary font-secondary">
                                Delete Event
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
                            <div class="flex justify-center mb-4 text-danger" aria-hidden="true">
                                <x-lucide-circle-alert class="h-12 w-12"/>
                            </div>
                            <h3 class="mb-5 text-lg font-normal text-primary-muted">Are you sure you
                                want to delete this event?</h3>
                            <x-tbv-button wire:click.prevent="delete" type="button">
                                Yes, I'm sure
                            </x-tbv-button>
                            <x-tbv-button_secondary wire:click="toggleModal" type="button">
                                No, cancel
                            </x-tbv-button_secondary>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>