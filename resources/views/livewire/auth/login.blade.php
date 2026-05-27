<x-layouts::auth :title="__('guest.login')">
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('guest.login_title')" :description="__('guest.login_description')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form class="flex flex-col gap-6" method="POST" action="{{ route('login.store') }}">
            @csrf

            <!-- Email Address -->
            <flux:input name="email" type="email" :label="__('common.form.email')" :value="old('email')" required autofocus autocomplete="email"
                placeholder="email@example.com" />

            <!-- Password -->
            <div class="relative">
                <flux:input name="password" type="password" :label="__('common.form.password')" required autocomplete="current-password"
                    :placeholder="__('common.form.password')" viewable />

                @if (Route::has('password.request'))
                    <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                        {{ __('guest.forgot_password') }}
                    </flux:link>
                @endif
            </div>

            <!-- Remember Me -->
            <flux:checkbox name="remember" :label="__('guest.remember')" :checked="old('remember')" />

            <div class="flex items-center justify-end">
                <flux:button class="w-full" data-test="login-button" type="submit" variant="primary">
                    {{ __('guest.login') }}
                </flux:button>
            </div>
        </form>

        @if (Route::has('register'))
            <div class="space-x-1 text-center text-sm text-zinc-600 rtl:space-x-reverse dark:text-zinc-400">
                <span>{{ __('guest.not_account') }}</span>
                <flux:link :href="route('register')" wire:navigate>{{ __('guest.register') }}</flux:link>
            </div>
        @endif
    </div>
</x-layouts::auth>
