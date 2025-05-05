<section class="w-full">
    <div class="relative w-full">
        <flux:heading size="xl" level="1">{{ __('Atnaujinti slaptažodį') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Ensure your account is using a long, random password to stay secure') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <x-settings.layout>
        <form wire:submit="updatePassword" class="mt-6 space-y-6">
            <flux:input
                wire:model="current_password"
                :label="__('Current password')"
                type="password"
                required
                autocomplete="current-password"
            />
            <flux:input
                wire:model="password"
                :label="__('New password')"
                type="password"
                required
                autocomplete="new-password"
            />
            <flux:input
                wire:model="password_confirmation"
                :label="__('Confirm Password')"
                type="password"
                required
                autocomplete="new-password"
            />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full">{{ __('Save') }}</flux:button>
                </div>

                <x-action-message class="me-3" on="password-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </x-settings.layout>
</section>
