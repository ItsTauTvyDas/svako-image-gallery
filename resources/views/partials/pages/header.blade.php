<header class="bg-body-tertiary py-3 mb-4 border-bottom">
    <div class="container d-flex flex-wrap align-items-center justify-content-center justify-content-md-between">
        <div class="col-md-3 mb-md-0">
            <x-app-logo/>
        </div>
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li>
                <a href="{{ route('home') }}" @class(['nav-link px-2', 'link-secondary' => request()->routeIs('home')])>{{ __('Pagrindinis') }}</a>
            </li>
            <li>
                <a href="{{ route('users-list') }}" @class(['nav-link px-2', 'link-secondary' => request()->routeIs('users-list')])>{{ __('Vartotojai') }}</a>
            </li>
            <li>
                <a href="{{ route('upload-rules') }}" @class(['nav-link px-2', 'link-secondary' => request()->routeIs('upload-rules')])>{{ __('Taisyklės') }}</a>
            </li>
        </ul>
        <div class="col-md-3 text-end">
            @auth
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <flux:icon.user variant="mini" class="d-inline"/> {{ auth()->user()->name }}
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile', ['id' => auth()->id()]) }}">{{ __('Viešas profilis') }}</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard') }}">{{ __('Valdymo skydas') }}</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">{{ __('Atsijungti') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">{{ __('Prisijungti') }}</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Registracija') }}</a>
                @endif
            @endauth
        </div>
    </div>
</header>
