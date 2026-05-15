<x-layouts::auth :title="__('messages.ui.confirm_title')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('messages.ui.confirm_title')" :description="__('messages.ui.confirm_description')" />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form class="flex flex-col gap-6" method="POST" action="{{ route('password.confirm.store') }}">
            @csrf

            <flux:input name="password" type="password" :label="__('messages.ui.password')" required autocomplete="current-password"
                :placeholder="__('messages.ui.password')" viewable />

            <flux:button class="w-full" data-test="confirm-password-button" type="submit" variant="primary">
                {{ __('messages.actions.confirm') }}
            </flux:button>
        </form>
    </div>
</x-layouts::auth>
