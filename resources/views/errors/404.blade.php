{{--@extends('errors::minimal')--}}

{{--@section('title', __('Not Found'))--}}
{{--@section('code', '404')--}}
{{--@section('message', __('Not Found'))--}}
<x-app-layout>

    <main class="grid min-h-full place-items-center bg-white dark:bg-gray-800 px-6 py-24 sm:py-32 lg:px-8">
        <div class="flex items-center gap-x-4">
            <div class="hidden sm:flex">
                <img class="h-40 w-40" src="{{asset('storage/backgrounds/magiceightball2.png')}}" alt="">
                <img class="h-40 w-40 -ml-14" src="{{asset('storage/backgrounds/magiceightball.png')}}" alt="">
            </div>
            <div class="text-center">
                <p class="text-3xl font-black text-orange-500">404</p>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl">Page not found</h1>
                <p class="mt-6 text-base leading-7 text-gray-500">Sorry, we couldn’t find the page you’re looking for.</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <x-links.btn-secondary href="/" class="px-3 py-2 text-xs font-medium">Go back home</x-links.btn-secondary>
                </div>
            </div>
        </div>
    </main>

</x-app-layout>
