<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <script type="text/javascript" src="/js/wangEditor.min.js"></script>

</head>
<body>
    <div id="app">
        @include('components.nav-bar')
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript">
        var E = window.wangEditor;
        var editor = new E('#editor');
        var $bodyText = $('#body-text');
        //var editor = new E(document.getElementById('editor'));
        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $bodyText.val(html)
        }
        editor.create();
    </script>
    <script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
</body>
</html>
