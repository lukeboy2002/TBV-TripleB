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
                      class="bg-transparent text-sm text-primary-muted placeholder-primary-muted rounded-lg block w-full p-2.5 border border-secondary/30 focus:border-secondary focus:outline-none focus:ring-0"
                      :rows="isEdit || focused ? '2' : '1'"
                      placeholder="Leave a comment"
                      required
            ></textarea>
                <x-form.error for="comment" class="mt-2"/>
            </div>
            <div class="flex justify-end space-x-2" :class="isEdit || focused ? '' : 'hidden'">
                <x-button.secondary @click="focused = false; isEdit = false; $wire.dispatch('cancelEditing')"
                                    type="button">
                    Cancel
                </x-button.secondary>
                <x-button.default wire:click="createComment" type="submit">
                    Submit
                </x-button.default>
            </div>
        </div>
    @else
        <div class="flex justify-end items-center space-x-1 rounded-lg p-4">
            <p class="text-primary text-xs">Only registered users can leave a comment.</p>
            <a href="{{route('login')}}"
               class="text-xs text-primary underline hover:text-secondary hover:underline focus:outline-none focus:text-secondary focus:underline">
                login
            </a>
        </div>
    @endauth
</div>