
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
    }" class="mb-4" >
        <div class="mb-2">
            <textarea x-ref="input" wire:model="comment" @click="focused = true"
                      id="comment"
                      name="comment"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                      :rows="isEdit || focused ? '2' : '1'"
                      placeholder="Leave a comment"
                      required
            ></textarea>
            <x-forms.input-error for="comment" class="mt-2" />
        </div>
        <div class="flex justify-end space-x-2" :class="isEdit || focused ? '' : 'hidden'">
            <x-buttons.secondary @click="focused = false; isEdit = false; $wire.dispatch('cancelEditing')" type="button" class="px-3 py-2 text-xs font-medium">
                Cancel
            </x-buttons.secondary>
            <x-buttons.primary wire:click="createComment" type="submit" class="px-3 py-2 text-xs font-medium">
                Submit
            </x-buttons.primary>
        </div>
    </div>
    @else
        <div class="flex justify-end items-center space-x-1">
            <p class="text-gray-900 dark:text-white text-xs">Only registered users can leave a comment.</p>
            <x-links.primary href="{{ route('login') }}"> Login</x-links.primary>
        </div>
    @endauth
</div>