<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('Panaikinti paskyrą') }}</flux:heading>
        <flux:subheading>{{ __('Panaikinkite savo paskyrą ir visus įkeltus paveikslus kartu.') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('Panaikinti paskyrą') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Ar jūs tikrai norite panaikinti savo paskyrą?') }}</flux:heading>

                <flux:subheading>
                    {{ __('Ištrynus Jūsų paskyrą, visi jos ištekliai ir duomenys bus visam laikui pašalinti. Prašome įvesti savo slaptažodį, kad patvirtintumėte, jog tikrai norite ištrinti savo paskyrą visam laikui.') }}
                </flux:subheading>
            </div>

            <flux:input wire:model="password" :label="__('Slaptažodis')" type="password" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Atšaukti') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" type="submit">{{ __('Panaikinti paskyrą') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</section>
