@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
    <h1 class="text-center">Perfil</h1>
@stop

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
                <div class="mt-4">
                    <img src="{{ asset('img/nombre.png') }}" alt="Imagen de perfil" class="mx-auto" style="max-width: 150px; ">
                </div>
                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>
                <div class="mt-4">
                    <img src="{{ asset('img/memes-07.png') }}" alt="contrasena.png" class="mx-auto" style="max-width: 150px; ">
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
                <div class="mt-4">
                    <img src="{{ asset('img/patrick.png') }}" alt="Imagen de perfil" class="mx-auto" style="max-width: 150px; ">
                </div>
            @endif
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@stop