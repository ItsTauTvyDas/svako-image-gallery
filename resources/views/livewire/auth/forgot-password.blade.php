 <div class="flex flex-col gap-6">
    <x-auth-header :title="__('Pamiršau slaptažodį')" :description="__('Įveskite Jūsų el. pašto adresą, kad gautumėte slaptažodžio atkūrimo nuorodą')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('El. pašto adresas')"
            type="email"
            required
            autofocus
            placeholder="vardas.pavardenis@gmail.com"
        />

        <flux:button variant="primary" type="submit" class="w-full">{{ __('Siųsti slaptažodžio atkūrimo nuorodą el. paštu') }}</flux:button>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
        {{ __('Arba') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('prisijungti') }}</flux:link>
    </div>
</div>
