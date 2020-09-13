<x-jet-action-section>
    <x-slot name="title">
        {{ trans('profile.two_factor_authentication.title') }}
    </x-slot>

    <x-slot name="description">
        {{ trans('profile.two_factor_authentication.content.add_additional_security') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                {{ trans('profile.two_factor_authentication.content.you_have_enabled') }}
            @else
                {{ trans('profile.two_factor_authentication.content.you_have_not_enabled') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ trans('profile.two_factor_authentication.content.when_two_factor_authentication_is_enabled') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ trans('profile.two_factor_authentication.content.two_factor_authentication_is_now_enabled') }}
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ trans('profile.two_factor_authentication.content.store_these_recovery_codes') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-button type="button" wire:click="enableTwoFactorAuthentication" wire:loading.attr="disabled">
                    {{ trans('profile.two_factor_authentication.content.enable') }}
                </x-jet-button>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-secondary-button class="mr-3" wire:click="regenerateRecoveryCodes">
                        {{ trans('profile.two_factor_authentication.content.regenerate_recovery_codes') }}
                    </x-jet-secondary-button>
                @else
                    <x-jet-secondary-button class="mr-3" wire:click="$toggle('showingRecoveryCodes')">
                        {{ trans('profile.two_factor_authentication.content.show_recovery_codes') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-danger-button wire:click="disableTwoFactorAuthentication" wire:loading.attr="disabled">
                    {{ trans('profile.two_factor_authentication.content.disable') }}
                </x-jet-danger-button>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
