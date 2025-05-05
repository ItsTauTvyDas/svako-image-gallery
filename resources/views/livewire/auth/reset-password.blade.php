<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Atstatyti slaptažodį')" :description="__('Įveskite naują slaptažodį žemiau')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="resetPassword" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('El. paštas')"
            type="email"
            required
            autocomplete="email"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Slaptažodis')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Slaptažodis')"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Patvirtinkite slaptažodį')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Patvirtinkite slaptažodį')"
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Atstatyti slaptažodį') }}
            </flux:button>
        </div>
    </form>
</div>
