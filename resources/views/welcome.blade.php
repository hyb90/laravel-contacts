<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Scripts -->
        <script src="https://contacts-hummam.herokuapp.com/js/app.js" defer></script>
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        
        <!-- Styles -->
        <link href="https://contacts-hummam.herokuapp.com/css/app.css" rel="stylesheet">
        <meta name='csrf-token' content="{{csrf_token()}}">
        </head>
        
        <body>
        <div id="app">
       <contacts></contacts>
        </div>
        </body>
</html>
