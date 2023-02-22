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
