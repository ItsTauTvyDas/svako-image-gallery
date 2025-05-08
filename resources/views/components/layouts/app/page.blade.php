<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body>
        @include('partials.theme-changer-bootstrap')
        @include('partials.pages.header')
        {{ $slot }}
        <footer class="text-body-secondary py-5">
            <div class="container">
                <p class="float-end mb-1">
                    <a href="#">{{ __('Grįžti į virtų') }}</a>
                </p>
                <p class="mb-1">© 2025 IkelkNuotrauka.lt - Visos teisės saugomos.</p>
            </div>
        </footer>
        @include('partials.foot')
    </body>
</html>
