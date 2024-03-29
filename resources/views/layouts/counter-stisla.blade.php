<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    @include('partials.stisla.styles')
</head>

<body class="orange layout-3">
    <div id="app">
        <div class="main-wrapper container">
            @include('partials.stisla.top-navigation')
            <div class="main-content">
                @yield('content')
            </div>
            @include('partials.stisla.footer')
        </div>
    </div>
    @include('partials.stisla.scripts')
    @yield("custom-javascript")
    @yield("chart-javascript")
</body>

</html>
