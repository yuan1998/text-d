<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @push('styles')
		<link rel="stylesheet" href="css/app.css">
        <link rel="stylesheet" type="text/css" href="node_modules/element-ui/lib/theme-chalk/index.css">
        @endpush
        <title>@section('title')</title>
    </head>
    <body>
        <div id="app">
            <div class="container">
                <div class="side-bar">
                    @yield('side-bar')
                </div>
                <div class="container">
                    <div class="top-bar">
                        @yield('top-bar')
                    </div>
                    <div class="main-bar">
                        @yield('main-bar')
                    </div>
                    <div class="footer-bar">
                        @yield('footer-bar')
                    </div>
                </div>
            </div>
        </div>
    </body>
    @push('scripts')
    <script type="text/javascript" src="js/app.js"></script>
    <script src="node_modules/element-ui/lib/index.js"></script>
    @endpush('script')
</html>

<script>
    console.log(Vue);
    window.Vue = Vue;
</script>
