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

        <flux:brand href="{{ route('mangas.index') }}" logo="{{ Storage::url('images/zaralib-logo.png') }}"></flux:brand>

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="rocket-launch" :href="route('mangas.index')" :current="request()->routeIs('mangas.index')" wire:navigate>
                {{ __('navigation.index') }}
            </flux:navbar.item>
            <flux:navbar.item icon="book-open" :href="route('mangas.library')" :current="request()->routeIs('mangas.library')" wire:navigate>
                {{ __('navigation.library') }}
            </flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        <flux:navbar class="py-0! me-1.5 space-x-0.5 max-lg:hidden rtl:space-x-reverse">
            <flux:modal.trigger name="search">
                <flux:tooltip :content="__('navigation.search')" position="bottom">
                    <flux:navbar.item class="h-10! [&>div>svg]:size-5" icon="magnifying-glass"></flux:navbar.item>
                </flux:tooltip>
            </flux:modal.trigger>
            <flux:dropdown>
                <flux:tooltip :content="__('navigation.language')" position="bottom">
                    <flux:navbar.item class="h-10! [&>div>svg]:size-5" icon="language"></flux:navbar.item>
                </flux:tooltip>
                <flux:navmenu>
                    <flux:navmenu.item href="{{ route('locale.switch', 'es') }}">{{ __('navigation.languages.es') }}</flux:navmenu.item>
                    <flux:navmenu.item href="{{ route('locale.switch', 'en') }}">{{ __('navigation.languages.en') }}</flux:navmenu.item>
                </flux:navmenu>
            </flux:dropdown>

        </flux:navbar>

        <x-desktop-user-menu />
    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar class="border-e border-zinc-200 bg-zinc-50 lg:hidden dark:border-zinc-700 dark:bg-zinc-900" collapsible="mobile" sticky>
        <flux:sidebar.header>
            <flux:brand href="{{ route('mangas.index') }}" logo="{{ Storage::url('images/zaralib-logo.png') }}"></flux:brand>
            <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('navigation.navigation')">
                <flux:sidebar.item icon="rocket-launch" :href="route('mangas.index')" :current="request()->routeIs('mangas.index')" wire:navigate>
                    {{ __('navigation.index') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="book-open" :href="route('mangas.library')" :current="request()->routeIs('mangas.library')" wire:navigate>
                    {{ __('navigation.library') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        <flux:sidebar.nav>
            <flux:modal.trigger name=search>
                <flux:sidebar.item icon="magnifying-glass">
                    {{ __('navigation.search') }}
                </flux:sidebar.item>
            </flux:modal.trigger>
            <flux:navlist.group :heading="__('navigation.language')" :expanded="false" expandable>
                <flux:navlist.item href="{{ route('locale.switch', 'es') }}">{{ __('navigation.languages.es') }}</flux:navlist.item>
                <flux:navlist.item href="{{ route('locale.switch', 'en') }}">{{ __('navigation.languages.en') }}</flux:navlist.item>
            </flux:navlist.group>
        </flux:sidebar.nav>
    </flux:sidebar>

    <livewire:search></livewire:search>
    {{ $slot }}

    @persist('toast')
        <flux:toast.group>
            <flux:toast />
        </flux:toast.group>
    @endpersist

    @fluxScripts
</body>

</html>
