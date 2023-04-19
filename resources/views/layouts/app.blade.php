<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mini Online Business</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;700;900&display=swap"
        rel="stylesheet">

    <link href="{{ URL('/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ URL('/css/templatemo-nomad-force.css') }}" rel="stylesheet">

</head>

<body>
    <header>
        @include('layouts.header')
    </header>
    <main class="container">
        @yield('content')
    </main>
    <footer>
        @include('layouts.footer')
    </footer>

    @include('sweetalert::alert')

    <script src="{{ URL('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL('/js/app.js') }}"></script>

    @yield('javascript')
</body>

</html>
