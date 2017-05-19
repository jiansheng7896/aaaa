<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="UTF-8">
    <title>111111111111111111</title>
{{--    <link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}
</head>
<body>
<div id="app">
    <div class="pit-loadding-box">
        <img src="{{ asset('backend/images/fly.gif') }}" class="pit-loading-img" alt="">
    </div>
</div>
<script>window.Laravel = {'csrfToken' : '{{csrf_token()}}','apiUrl':'{{ route('single') }}'};</script>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>