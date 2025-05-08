@if (!request()->is('dashboard*') && !request()->is('system/*'))
    @vite([
        'resources/js/app.js',
        'resources/js/color-modes.js'
    ])
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@fluxScripts
@livewireScripts
@stack('footer-scripts')

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.hook('request', ({ fail }) => {
            fail(({ status, preventDefault }) => {
                if (status === 419) {
                    location.reload();
                    preventDefault();
                }
            })
        })
    })
</script>
