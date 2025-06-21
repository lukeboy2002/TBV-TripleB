@props(['submit'])

<div>
    <div class="mt-5">
        <form wire:submit="{{ $submit }}">
            <div class="pr-4 py-5 sm:p-6 shadow-sm }}">
                <div class="space-y-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-end px-4 py-3 text-end sm:px-6 shadow-sm">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
