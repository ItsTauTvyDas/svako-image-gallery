<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Sukurti paskyrą')" :description="__('Įveskite žemiau savo duomenis, kad sukurtumėte paskyrą')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Vardas')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Pilnas vardas')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('El. paštas')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
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
                {{ __('Sukurti paskyrą') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Jau turite paskyrą?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Prisijungti') }}</flux:link>
    </div>
</div>
