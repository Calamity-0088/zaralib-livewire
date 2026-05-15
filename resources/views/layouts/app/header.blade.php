<!DOCTYPE html>
<html class="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
    <link href="https://fonts.bunny.net" rel="preconnect">
    <link href="https://fonts.bunny.net/css?family=inter:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header class="border-b border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900" container>
        <flux:sidebar.toggle class="mr-2 lg:hidden" icon="bars-2" inset="left" />

        <x-app-logo href="{{ route('mangas.index') }}" wire:navigate />

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="book-open" :href="route('mangas.index')" :current="request()->routeIs('mangas.index')" wire:navigate>
                {{ __('messages.navigation.index') }}
            </flux:navbar.item>
            <flux:navbar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        <flux:navbar class="py-0! me-1.5 space-x-0.5 rtl:space-x-reverse">
            <livewire:search></livewire:search>
            <flux:dropdown>
                <flux:tooltip :content="__('messages.navigation.language')" position="bottom">
                    <flux:navbar.item icon="language"></flux:navbar.item>
                </flux:tooltip>
                <flux:navmenu>
                    <flux:navmenu.item href="{{ route('locale.switch', 'es') }}">{{ __('messages.ui.es') }}</flux:navmenu.item>
                    <flux:navmenu.item href="{{ route('locale.switch', 'en') }}">{{ __('messages.ui.en') }}</flux:navmenu.item>
                </flux:navmenu>
            </flux:dropdown>

        </flux:navbar>

        <x-desktop-user-menu />
    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar class="border-e border-zinc-200 bg-zinc-50 lg:hidden dark:border-zinc-700 dark:bg-zinc-900" collapsible="mobile" sticky>
        <flux:sidebar.header>
            <x-app-logo href="{{ route('dashboard') }}" :sidebar="true" wire:navigate />
            <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('Platform')">
                <flux:sidebar.item icon="layout-grid" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        <flux:sidebar.nav>
            <flux:sidebar.item href="https://github.com/laravel/livewire-starter-kit" icon="folder-git-2" target="_blank">
                {{ __('Repository') }}
            </flux:sidebar.item>
            <flux:sidebar.item href="https://laravel.com/docs/starter-kits#livewire" icon="book-open-text" target="_blank">
                {{ __('Documentation') }}
            </flux:sidebar.item>
        </flux:sidebar.nav>
    </flux:sidebar>

    {{ $slot }}

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts
</body>

</html>
