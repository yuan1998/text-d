<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/app.css">
        <title>Laravel</title>
    </head>
    <body>
        <div id="app">
        	<App></App>
        </div>
    </body>
    <script type="text/javascript" src="js/app.js"></script>
</html>
