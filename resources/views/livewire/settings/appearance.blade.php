<section class="w-full">
    <div class="relative w-full">
        <flux:heading size="xl" level="1">{{ __('Appearance') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Update the appearance settings for your account') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <x-settings.layout>
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('Light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('Dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('System') }}</flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</section>
