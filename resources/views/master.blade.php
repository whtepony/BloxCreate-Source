

@php
    $title = (isset($pageTitle)) ? $pageTitle .' | ' . config('app.name') : config('app.name');
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.metadata')
    <title>{{ $title }}</title>
</head>
<body class="{{ $bodyClass ?? '' }}">
    <div id="app">
        @if (!isset($blank))
            @include('layout.topbar')
            @include('layout.sidebar')
            @include('layout.banner')
        @endif

        <div class="page-wrapper">
            <div class="grid-container {{ isset($gridFluid) ? 'fluid' : '' }} {{ $gridClass ?? '' }}">
                <div class="grid-x">
                    <div class="cell medium-10 medium-offset-1">
                        @include('layout.alerts')
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        @if (!isset($blank))
            @include('layout.footer')
        @endif
    </div>

    @include('layout.scripts')
</body>
</html>
