@props(['name'])

@if ($name === 'down-arrow')
    <svg {{ $attributes(['class' => 'ml-2 w-4 h-4 text-white']) }}
         aria-hidden="true"
         fill="none"
         stroke="currentColor"
         viewBox="0 0 24 24"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M19 9l-7 7-7-7">
        </path>
    </svg>
@endif

@if ($name === 'error')
    <svg {{ $attributes(['class' => 'w-6 h-6 ']) }}
         fill="none"
         stroke="currentColor"
         stroke-width="1.5"
         viewBox="0 0 24 24"
         xmlns="http://www.w3.org/2000/svg">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z">
        </path>
    </svg>
@endif

@if ($name === 'check')
    <svg {{ $attributes(['class' => 'w-6 h-6 ']) }}
         fill="none"
         stroke="currentColor"
         stroke-width="1.5"
         viewBox="0 0 24 24"
         xmlns="http://www.w3.org/2000/svg">

        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="m4.5 12.75 6 6 9-13.5">
        </path>
    </svg>
@endif

@if ($name === 'dirnotset')
    <svg class="ml-1 w-4 h-4"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"
        />
    </svg>
@endif

@if ($name === 'asc')
    <svg class="ml-1 w-4 h-4"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M4.5 15.75l7.5-7.5 7.5 7.5"
        />
    </svg>
@endif

@if ($name === 'desc')
    <svg class="ml-1 w-4 h-4"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M19.5 8.25l-7.5 7.5-7.5-7.5"
        />
    </svg>
@endif

@if ($name === 'x-mark')
    <svg class="w-4 h-4 ml-2"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round"
              troke-linejoin="round"
              d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"
        />
    </svg>
@endif
