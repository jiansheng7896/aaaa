<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="UTF-8">
    <title>管理后台</title>
    <link rel="stylesheet" href="{{ mix('adm/css/app.css') }}">
</head>
<body>
<div id="app">
    ...
</div>
<script>window.Laravel = {'csrfToken' : '{{csrf_token()}}','apiUrl':''};</script>
<script src="{{ mix('adm/js/app.js') }}"></script>
</body>
</html>