<section class="antialiased [&:not(:last-child)]:border-b border-secondary/30">
    <div class="max-w-7xl mx-auto">
        <article class="px-6 py-3">
            <header class="flex justify-between items-center mb-2">
                <div class="flex items-center">
                    <p class="inline-flex items-center mr-3 text-sm text-primary font-semibold">
                        <img class="mr-2 w-6 h-6 rounded-full" src="{{ $comment->user->profile_photo_url }}"
                             alt="{{ $comment->user->username }}">
                        {{ ucfirst($comment->user->username) }}
                    </p>
                    <p class="text-xs text-primary-muted">
                        <time>{{ $comment->getFormattedDate() }}</time>
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <livewire:likes type="comment" id="{{ $comment->id }}"/>

                    @can('update', $comment)
                        <x-button.icon_sm wire:click.prevent="startCommentEdit"
                                          icon="edit"
                                          class="text-edit"/>
                    @endcan

                    @can('delete', $comment)
                        <x-button.icon_sm wire:click="toggleModal"
                                          icon="trash"
                                          class="text-error"/>
                    @endcan
                </div>
            </header>
            @if($editing)
                <livewire:comments.create :comment-model="$comment"/>
            @else
                <div class="flex justify-between items-end">
                    <div class="text-primary-muted text-sm">
                        {{$comment->comment}}
                    </div>
                    @auth
                        <a wire:click.prevent="startReply"
                           class="inline-flex items-center px-4 text-sm text-primary hover:text-secondary focus:outline-none focus:text-secondary transition ease-in-out duration-150">
                            <x-lucide-message-square-reply class="h-4 w-4 mr-1"/>
                            Reply
                        </a>
                    @endauth
                </div>
            @endif

            @if ($replying)
                <div class="pt-4">
                    <livewire:comments.create :post="$comment->post" :parent-comment="$comment"/>
                </div>
            @endif
        </article>
        @if ($comment->comments->count())
            @foreach($comment->comments as $childComment)
                <div class="ml-6">
                    <livewire:comments.item :comment="$childComment" wire:key="comment-{{$childComment->id}}"/>
                </div>
            @endforeach
        @endif
    </div>
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
                                Delete Comment
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
                                want to delete this comment?</h3>
                            <x-button.default wire:click.prevent="deleteComment" type="button">
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
</section>
