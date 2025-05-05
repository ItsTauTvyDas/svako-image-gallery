<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Prisijunkite prie savo paskyros')" :description="__('Įveskite Jūsų el. pašto adresą ir slaptažodį žemiau, kad prisijungtumėte')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('El. pašto adresas')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Slaptažodis')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Slaptažodis')"
            />

            @if (Route::has('password.request'))
                <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                    {{ __('Pamiršote slaptažodį?') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" :label="__('Prisiminti mane')" />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">{{ __('Prisijungti') }}</flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('Neturite paskyros?') }}
            <flux:link :href="route('register')" wire:navigate>{{ __('Registracija') }}</flux:link>
        </div>
    @endif
</div>
