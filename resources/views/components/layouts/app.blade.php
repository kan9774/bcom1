<?php

use App\Livewire\Actions\Logout;

new class extends \Livewire\Component {
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}


?>
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @bukStyles
    @bukScripts
</head>
<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">
{{-- NAVBAR mobile only --}}
<x-mary-nav sticky full-width>
    <x-slot:brand>
        <a href="{{route('dashboard')}}">
            <img src="{{asset('img/logo/heraldica.png')}}" class="ml-5 pt-5 h-16 w-auto" alt="Logo Heraldica">
        </a>
    </x-slot:brand>
    <x-slot:actions>
        <label for="main-drawer" class="lg:hidden mr-3">
            <x-mary-icon name="o-bars-3" class="cursor-pointer"/>
        </label>
        <x-mary-theme-toggle class="btn" @theme-changed="console.log($event.detail)"/>
    </x-slot:actions>
</x-mary-nav>

{{-- MAIN --}}
<x-mary-main full-width>
    {{-- SIDEBAR --}}
    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

        {{-- BRAND --}}


        {{-- MENU --}}
        <x-mary-menu activate-by-route>

            {{-- User --}}
            @if($user = auth()->user())
                <x-mary-menu-separator/>

                <x-mary-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                                  class="-mx-2 !-my-2 rounded">
                    <x-slot:actions>
                        <x-mary-menu-sub title="{{__('Settings')}}" icon="o-cog-8-tooth">
                            <livewire:admin.logout/>
                            <x-mary-menu-item title="Profile" icon="o-user" link="/profile"/>
                        </x-mary-menu-sub>
                    </x-slot:actions>
                </x-mary-list-item>

                <x-mary-menu-separator/>
            @endif

            <x-mary-menu-item title="{{__('Users')}}" icon="o-user-group" link="{{route('users.index')}}"/>
            <x-mary-menu-sub title="Settings" icon="o-cog-6-tooth">
                <x-mary-menu-item title="Wifi" icon="o-wifi" link="####"/>
                <x-mary-menu-item title="Archives" icon="o-archive-box" link="####"/>
            </x-mary-menu-sub>
        </x-mary-menu>
    </x-slot:sidebar>

    {{-- The `$slot` goes here --}}

    <x-slot:content>
        {{ $slot }}
        @if(isset($header))
            <header class="bg-white dark:bg-gray-600 shadow rounded-md">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
    </x-slot:content>
</x-mary-main>

{{-- Toast --}}
<x-mary-toast/>
{{-- Theme toggle --}}

</body>
</html>
