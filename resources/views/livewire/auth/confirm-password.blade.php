<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('Patvirtinkite slaptažodį')"
        :description="__('Tai yra programos saugi sritis. Prašome patvirtinti savo slaptažodį prieš tęsiant.')"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="confirmPassword" class="flex flex-col gap-6">
        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Slaptažodis')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Slaptažodis')"
        />

        <flux:button variant="primary" type="submit" class="w-full">{{ __('Patvirtinti') }}</flux:button>
    </form>
</div>
