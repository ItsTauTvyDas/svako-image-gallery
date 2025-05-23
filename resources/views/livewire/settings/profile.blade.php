<section class="w-full">
    <div class="relative w-full">
        <flux:heading size="xl" level="1">{{ __('Profilis') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Atnaujinkite savo vardą ir el. pašto adresą') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <x-settings.layout>
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            <flux:input wire:model="name" :label="__('Vardas')" type="text" required autofocus autocomplete="name" />

            <div>
                <flux:input wire:model="email" :label="__('El. Paštas')" type="email" required autocomplete="email" />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Jūsų el. paštas nėra patvirtintas.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Spauskite čia norėdami vėl gauti patvirtinimo laišką.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('Naujas patvirtinimo laiškas buvo nusiųstas į jūsų el. paštą.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Išsaugoti') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Išsaugota!') }}
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
