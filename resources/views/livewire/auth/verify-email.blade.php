<div class="mt-4 flex flex-col gap-6">
    <flux:text class="text-center">
        {{ __('Prašome patvirtinti savo el. pašto adresą spustelėdami nuorodą, kurią ką tik jums išsiuntėme el. paštu.') }}
    </flux:text>

    @if (session('status') == 'verification-link-sent')
        <flux:text class="text-center font-medium !dark:text-green-400 !text-green-600">
            {{ __('Nauja patvirtinimo nuoroda išsiųsta į Jūsų registracijos metu nurodytą el. pašto adresą.') }}
        </flux:text>
    @endif

    <div class="flex flex-col items-center justify-between space-y-3">
        <flux:button wire:click="sendVerification" variant="primary" class="w-full">
            {{ __('Siųsti patvirtinimo el. laišką dar kartą') }}
        </flux:button>

        <flux:link class="text-sm cursor-pointer" wire:click="logout">
            {{ __('Atsijungti') }}
        </flux:link>
    </div>
</div>
