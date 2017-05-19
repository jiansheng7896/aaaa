<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="@yield('keywords', 'keywords')" />
        <title>{{ config('setting.title') }} @yield('title', '欢迎您')</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}" />

        <script>
            window.Laravel = '{!! json_encode(['csrfToken' => csrf_token()])  !!}'
        </script>
        @yield('css')
    </head>
    <body>

    <div id="app">
        ...
    </div>


    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/common.js') }}"></script>
    @yield('js')
    </body>
</html>
