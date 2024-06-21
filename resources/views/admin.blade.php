

@php
    if (isset($pageTitle)) {
        $title = $pageTitle . ' | BC Administration';
    } else {
        $title = 'BC Administration';
    }

    $random = rand();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.metadata-admin')
    <title>{{ $title }}</title>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('layout.topbar-admin')
        @include('layout.sidebar-admin')
        <div class="content-wrapper">
            @yield('header')
            <section class="content container-fluid">
                @include('layout.alerts-admin')
                @yield('content')
            </section>
        </div>
        @include('layout.footer-admin')
    </div>

    @include('layout.scripts-admin')
</body>
</html>
