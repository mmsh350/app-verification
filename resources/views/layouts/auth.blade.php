<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', $settings->site_name ?? config('app.name'))</title>

    <!-- Plugins: CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor.bundle.base.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="shortcut icon"
        href="{{ asset('assets/images/' . $settings->favicon ?? 'assets/images/default_favicon.png') }}">
    @stack('styles')
</head>

<body>
    <div class="page-loading " id="loader">
        <div class="page-loading-inner">

            <div class="square-box-loader mb-5">
                <div class="square-box-loader-container">
                    <div class="square-box-loader-corner-top"></div>
                    <div class="square-box-loader-corner-bottom"></div>
                </div>
                <div class="square-box-loader-square"></div>
            </div>

            <h6 class="loader-text">
                {{ $settings->short_name ?? config('app.name') }}
            </h6>

        </div>

    </div>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Plugins: JS -->
    <script src="{{ asset('assets/js/vendor.bundle.base.js') }}"></script>

    <!-- Custom Scripts -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @stack('scripts')
</body>

</html>
