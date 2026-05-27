<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('settings.delete.label') }}</flux:heading>
        <flux:subheading>{{ __('settings.delete.description') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('settings.delete.label') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal class="max-w-lg" name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable>
        <form class="space-y-6" method="POST" wire:submit="deleteUser">
            <div>
                <flux:heading size="lg">{{ __('settings.delete.alert_title') }}</flux:heading>

                <flux:subheading>
                    {{ __('settings.delete.alert_description') }}
                </flux:subheading>
            </div>

            <flux:input type="password" wire:model="password" :label="__('common.form.password')" viewable />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('common.actions.cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger">{{ __('settings.delete.label') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</section>
