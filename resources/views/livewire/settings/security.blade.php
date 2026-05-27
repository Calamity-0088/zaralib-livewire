<section class="w-full">
    @include('partials.settings-heading')

    <flux:heading class="sr-only">{{ __('Security settings') }}</flux:heading>

    <x-settings.layout :heading="__('settings.security.update_password')" :subheading="__('settings.security.description')">
        <form class="mt-6 space-y-6" method="POST" wire:submit="updatePassword">
            <flux:input type="password" wire:model="current_password" :label="__('common.form.current_password')" required
                autocomplete="current-password" viewable />
            <flux:input type="password" wire:model="password" :label="__('common.form.new_password')" required autocomplete="new-password" viewable />
            <flux:input type="password" wire:model="password_confirmation" :label="__('common.form.confirm_password')" required
                autocomplete="new-password" viewable />

            <div class="flex items-center gap-4">
                <flux:button data-test="update-password-button" type="submit" variant="primary">{{ __('common.actions.save') }}</flux:button>
            </div>
        </form>

        @if ($canManageTwoFactor)
            <section class="mt-12">
                <flux:heading>{{ __('settings.2fa.title') }}</flux:heading>
                <flux:subheading>{{ __('settings.2fa.subtitle') }}</flux:subheading>

                <div class="mx-auto flex w-full flex-col space-y-6 text-sm" wire:cloak>
                    @if ($twoFactorEnabled)
                        <div class="space-y-4">
                            <flux:text>
                                {{ __('You will be prompted for a secure, random pin during login, which you can retrieve from the TOTP-supported application on your phone.') }}
                            </flux:text>

                            <div class="flex justify-start">
                                <flux:button variant="danger" wire:click="disable">
                                    {{ __('Disable 2FA') }}
                                </flux:button>
                            </div>

                            <livewire:settings.two-factor.recovery-codes :$requiresConfirmation />
                        </div>
                    @else
                        <div class="space-y-4">
                            <flux:text variant="subtle">
                                {{ __('settings.2fa.description') }}
                            </flux:text>

                            <flux:button variant="primary" wire:click="enable">
                                {{ __('settings.2fa.enable') }}
                            </flux:button>
                        </div>
                    @endif
                </div>
            </section>

            <flux:modal class="md:min-w-md max-w-md" name="two-factor-setup-modal" @close="closeModal" wire:model="showModal">
                <div class="space-y-6">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="w-auto rounded-full border border-stone-100 bg-white p-0.5 shadow-sm dark:border-stone-600 dark:bg-stone-800">
                            <div
                                class="relative overflow-hidden rounded-full border border-stone-200 bg-stone-100 p-2.5 dark:border-stone-600 dark:bg-stone-200">
                                <div
                                    class="absolute inset-0 flex h-full w-full items-stretch justify-around divide-x divide-stone-200 opacity-50 dark:divide-stone-300 [&>div]:flex-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div></div>
                                    @endfor
                                </div>

                                <div
                                    class="absolute inset-0 flex h-full w-full flex-col items-stretch justify-around divide-y divide-stone-200 opacity-50 dark:divide-stone-300 [&>div]:flex-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <div></div>
                                    @endfor
                                </div>

                                <flux:icon.qr-code class="dark:text-accent-foreground relative z-20" />
                            </div>
                        </div>

                        <div class="space-y-2 text-center">
                            <flux:heading size="lg">{{ $this->modalConfig['title'] }}</flux:heading>
                            <flux:text>{{ $this->modalConfig['description'] }}</flux:text>
                        </div>
                    </div>

                    @if ($showVerificationStep)
                        <div class="space-y-6">
                            <div class="flex flex-col items-center justify-center space-y-3">
                                <flux:otp class="mx-auto" name="code" wire:model="code" length="6" label="OTP Code" label:sr-only />
                            </div>

                            <div class="flex items-center space-x-3">
                                <flux:button class="flex-1" variant="outline" wire:click="resetVerification">
                                    {{ __('Back') }}
                                </flux:button>

                                <flux:button class="flex-1" variant="primary" wire:click="confirmTwoFactor" x-bind:disabled="$wire.code.length < 6">
                                    {{ __('Confirm') }}
                                </flux:button>
                            </div>
                        </div>
                    @else
                        @error('setupData')
                            <flux:callout variant="danger" icon="x-circle" heading="{{ $message }}" />
                        @enderror

                        <div class="flex justify-center">
                            <div class="relative aspect-square w-64 overflow-hidden rounded-lg border border-stone-200 dark:border-stone-700">
                            @empty($qrCodeSvg)
                                <div class="absolute inset-0 flex animate-pulse items-center justify-center bg-white dark:bg-stone-700">
                                    <flux:icon.loading />
                                </div>
                            @else
                                <div class="flex h-full items-center justify-center p-4" x-data>
                                    <div class="rounded bg-white p-3"
                                        :style="($flux.appearance === 'dark' || ($flux.appearance === 'system' && $flux.dark)) ?
                                        'filter: invert(1) brightness(1.5)' : ''">
                                        {!! $qrCodeSvg !!}
                                    </div>
                                </div>
                            @endempty
                        </div>
                    </div>

                    <div>
                        <flux:button class="w-full" :disabled="$errors->has('setupData')" variant="primary"
                            wire:click="showVerificationIfNecessary">
                            {{ $this->modalConfig['buttonText'] }}
                        </flux:button>
                    </div>

                    <div class="space-y-4">
                        <div class="relative flex w-full items-center justify-center">
                            <div class="absolute inset-0 top-1/2 h-px w-full bg-stone-200 dark:bg-stone-600"></div>
                            <span class="relative bg-white px-2 text-sm text-stone-600 dark:bg-stone-800 dark:text-stone-400">
                                {{ __('settings.2fa.manual_code') }}
                            </span>
                        </div>

                        <div class="flex items-center space-x-2" x-data="{
                            copied: false,
                            async copy() {
                                try {
                                    await navigator.clipboard.writeText('{{ $manualSetupKey }}');
                                    this.copied = true;
                                    setTimeout(() => this.copied = false, 1500);
                                } catch (e) {
                                    console.warn('Could not copy to clipboard');
                                }
                            }
                        }">
                            <div class="flex w-full items-stretch rounded-xl border dark:border-stone-700">
                            @empty($manualSetupKey)
                                <div class="flex w-full items-center justify-center bg-stone-100 p-3 dark:bg-stone-700">
                                    <flux:icon.loading variant="mini" />
                                </div>
                            @else
                                <input class="w-full bg-transparent p-3 text-stone-900 outline-none dark:text-stone-100" type="text"
                                    value="{{ $manualSetupKey }}" readonly />

                                <button class="cursor-pointer border-l border-stone-200 px-3 transition-colors dark:border-stone-600"
                                    @click="copy()">
                                    <flux:icon.document-duplicate x-show="!copied" variant="outline"></flux:icon>
                                        <flux:icon.check class="text-green-500" x-show="copied" variant="solid">
                                            </flux:icon>
                                </button>
                            @endempty
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </flux:modal>
@endif
</x-settings.layout>
</section>
