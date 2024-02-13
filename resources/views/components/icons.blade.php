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

@if ($name === 'clock')
    <svg class="w-4 h-4 mx-2"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
        />
    </svg>
@endif

@if ($name === 'user')
    <svg class="w-4 h-4 mx-2"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
        />
    </svg>
@endif

@if ($name === 'view')
    <svg class="w-4 h-4 mx-2"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
        />
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
        />
    </svg>
@endif

@if ($name === 'reading')
    <svg class="w-4 h-4 mx-2"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"
        />
    </svg>
@endif

@if ($name === 'comment')
    <svg class="w-4 h-4 mx-2"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3a49.5 49.5 0 0 1-4.02-.163 2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"
        />
    </svg>
@endif

@if ($name === 'heart')
    <svg class="w-4 h-4 mx-2"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round"
              stroke-linejoin="round"
              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"
        />
    </svg>
@endif
