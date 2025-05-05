<section class="w-full">
    <div class="relative w-full">
        <flux:heading size="xl" level="1">{{ __('Atnaujinti slaptažodį') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Įsitikinkite, kad Jūsų paskyra naudoja ilgą, atsitiktinį slaptažodį, kad išliktumėte saugūs.') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <x-settings.layout>
        <form wire:submit="updatePassword" class="mt-6 space-y-6">
            <flux:input
                wire:model="current_password"
                :label="__('Dabartinis slaptažodis')"
                type="password"
                required
                autocomplete="current-password"
            />
            <flux:input
                wire:model="password"
                :label="__('Naujas slaptažodis')"
                type="password"
                required
                autocomplete="new-password"
            />
            <flux:input
                wire:model="password_confirmation"
                :label="__('Patvirtinkite naują slaptažodį')"
                type="password"
                required
                autocomplete="new-password"
            />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Išsaugoti') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="password-updated">
                    {{ __('Išsaugota!') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>
