<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ (isset($title) ? "$title - " : '') . __('Paveikslų Galerija') }}</title>

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite([
    'resources/css/app.css',
    'resources/js/app.js'
])

@if (!request()->is('dashboard*') && !request()->is('system/*'))
    @vite([
        'resources/css/bootstrap.min.css',
        'resources/css/main-style.css',
    ])
@endif

@stack('head-scripts')
@fluxAppearance
