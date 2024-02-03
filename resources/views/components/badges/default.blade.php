@props(['Color'])

@php
    $Color = match ($Color) {
        'blue' => 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300',
        'gray' => 'bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300',
        'red' => 'bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-300',
        'green' => 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300',
        'yellow' => 'bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300',
        'indigo' => 'bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-300',
        'purple' => 'bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-300',
        'pink' => 'bg-pink-100 dark:bg-pink-900 text-pink-800 dark:text-pink-300',
        'orange' => 'bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-300',
    };
@endphp

<button {{ $attributes }} class="{{ $Color }} text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{ $slot }}</button>


