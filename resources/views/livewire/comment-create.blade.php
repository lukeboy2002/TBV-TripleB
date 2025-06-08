<div>
    @auth
        <div x-data="{
            focused: {{ $parentComment ? 'true' : 'false' }},
            isEdit: {{ $commentModel ? 'true' : 'false'}},
            init() {
                if (this.isEdit || this.focused)
                    this.$refs.input.focus();

                $wire.on('commentCreated', () => {
                    this.focused = false;
                })
            }
    }" class="mb-4">
            <div class="mb-2">
            <textarea x-ref="input" wire:model="comment" @click="focused = true"
                      id="comment"
                      name="comment"
                      class="bg-input border border-border text-primary text-sm rounded-lg focus:ring-ring focus:border-border block w-full p-2.5"
                      :rows="isEdit || focused ? '2' : '1'"
                      placeholder="Leave a comment"
                      required
            ></textarea>
                <x-tbv-input-error for="comment" class="mt-2"/>
            </div>
            <div class="flex justify-end space-x-2" :class="isEdit || focused ? '' : 'hidden'">
                <x-tbv-button_secondary @click="focused = false; isEdit = false; $wire.dispatch('cancelEditing')"
                                        type="button">
                    Cancel
                </x-tbv-button_secondary>
                <x-tbv-button wire:click="createComment" type="submit">
                    Submit
                </x-tbv-button>
            </div>
        </div>
    @else
        <div class="flex justify-end items-center space-x-1 bg-neutral-800 rounded-lg p-4">
            <p class="text-primary text-xs">Only registered users can leave a comment.</p>
            <livewire:auth.login-modal type="text"/>

        </div>
    @endauth
</div>