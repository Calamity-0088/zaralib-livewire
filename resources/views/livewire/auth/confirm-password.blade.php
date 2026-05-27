<x-layouts::auth :title="__('common.form.confirm_title')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('common.form.confirm_title')" :description="__('common.form.confirm_description')" />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form class="flex flex-col gap-6" method="POST" action="{{ route('password.confirm.store') }}">
            @csrf

            <flux:input name="password" type="password" :label="__('common.form.password')" required autocomplete="current-password"
                :placeholder="__('common.form.password')" viewable />

            <flux:button class="w-full" data-test="confirm-password-button" type="submit" variant="primary">
                {{ __('common.actions.confirm') }}
            </flux:button>
        </form>
    </div>
</x-layouts::auth>
