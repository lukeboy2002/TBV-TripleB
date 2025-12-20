{{--@extends('errors::minimal')--}}

{{--@section('title', __('Forbidden'))--}}
{{--@section('code', '403')--}}
{{--@section('message', __($exception->getMessage() ?: 'Forbidden'))--}}


<x-guest-layout title="{{ __('Forbidden') }}">
    <div class="flex flex-col justify-center items-center h-screen max-w-7xl">
        <div class="border border-secondary/30 rounded-lg p-10">
            <div class="flex items-center justify-center mb-6">
                <x-lucide-octagon-x class="w-16 h-16 text-error"/>
            </div>

            <div class="flex items-center justify-center mb-6 text-2xl text-error font-black font-secondary">
                403 | {{ __('You have no access to this page.') }}
            </div>
            <div class="flex items-center justify-end">
                <x-link.default href="{{ url()->previous() !== url()->current()
                        ? url()->previous()
                        : route('home') }}"
                >
                    {{ __('Back') }}
                </x-link.default>
            </div>
        </div>
    </div>
</x-guest-layout>