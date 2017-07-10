<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="keywords" content="@yield('keywords', config('app.name'))" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name') }}-@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/base.css') }}" />
    @yield('css')
    <script type="text/javascript" src="{{ asset('web/js/jquery.min.js') }}"></script>
</head>

<body>
@yield('content')

<script src="{{ asset('web/plugins/layer/layer.js') }}"></script>
@yield('js')
</body>
</html>