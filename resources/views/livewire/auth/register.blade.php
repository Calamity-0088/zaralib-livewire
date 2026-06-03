<x-layouts::auth :title="__('guest.register')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('guest.register_title')" :description="__('guest.register_description')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form class="flex flex-col gap-6" method="POST" action="{{ route('register.store') }}">
            @csrf
            <!-- Name -->
            <flux:input name="name" type="text" :label="__('common.form.name')" :value="old('name')" required autofocus autocomplete="name"
                :placeholder="__('common.form.full_name')" />

            <!-- Email Address -->
            <flux:input name="email" type="email" :label="__('common.form.email')" :value="old('email')" required autocomplete="email"
                placeholder="email@example.com" />

            <!-- Password -->
            <flux:input name="password" type="password" :label="__('common.form.password')" required autocomplete="new-password"
                :placeholder="__('common.form.password')" viewable />

            <!-- Confirm Password -->
            <flux:input name="password_confirmation" type="password" :label="__('common.form.confirm_password')" required autocomplete="new-password"
                :placeholder="__('common.form.confirm_password')" viewable />

            <div class="flex items-center justify-end">
                <flux:button class="w-full" data-test="register-user-button" type="submit" variant="primary">
                    {{ __('guest.create_account') }}
                </flux:button>
            </div>
        </form>

        <div class="space-x-1 text-center text-sm text-zinc-600 rtl:space-x-reverse dark:text-zinc-400">
            <span>{{ __('guest.have_account') }}</span>
            <flux:link :href="route('login')" wire:navigate>{{ __('guest.login') }}</flux:link>
        </div>
    </div>
</x-layouts::auth>
