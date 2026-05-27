<section class="w-full">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Profile settings') }}</flux:heading>

    <x-settings.layout :heading="__('settings.tabs.profile')" :subheading="__('settings.profile.description')">
        <form class="my-6 w-full space-y-6" wire:submit="updateProfileInformation">
            <flux:input type="text" wire:model="name" :label="__('common.form.name')" required autofocus autocomplete="name" />

            <div>
                <flux:input type="email" wire:model="email" :label="__('common.form.email')" required autocomplete="email" />

                @if ($this->hasUnverifiedEmail)
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Your email address is unverified.') }}

                            <flux:link class="cursor-pointer text-sm" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                        </flux:text>

                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <flux:button type="submit" variant="primary">{{ __('common.actions.save') }}</flux:button>
            </div>
        </form>

        @if ($this->showDeleteUser)
            <livewire:settings.delete-user-form />
        @endif
    </x-settings.layout>
</section>
