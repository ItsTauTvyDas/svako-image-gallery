<section class="w-full">
    <div class="relative w-full">
        <flux:heading size="xl" level="1">{{ __('Ataskaita') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Atsisiųskite savo paskyros duomenų ataskaitą PDF formatu.') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <div class="mt-3">
        @if (session()->has('message'))
            <div class="ms-5 mb-3">
                {{ session('message') }}
            </div>
        @endif
        <flux:button target="_blank" :href="route('pdf.preview.html')">{{ __('Peržiūrėti PDF HTML formatu') }}</flux:button>
        <flux:button target="_blank" :href="route('pdf.preview.file')">{{ __('Peržiūrėti PDF failą') }}</flux:button>
        <flux:button target="_blank" :href="route('pdf.download')">{{ __('Atsisiųsti') }}</flux:button>
        <flux:button wire:click="sendToMail">{{ __('Atsiųsti į paštą') }}</flux:button>
    </div>
</section>
