<section class="w-full">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Appearance settings') }}</flux:heading>

    <x-settings.layout :heading="__('messages.settings.appearance')" :subheading="__('messages.settings.appearance_description')">
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('messages.actions.light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('messages.actions.dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('messages.actions.system') }}</flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</section>
