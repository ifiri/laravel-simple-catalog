@include('layouts.header', ['searchstring' => $searchstring ?? ''])

<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Goods Catalog</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="/css/app.css"></style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @yield('header')

            <div class="container">
                @yield('content')
                @yield('grid')
            </div>
        </div>
    </body>
</html>
