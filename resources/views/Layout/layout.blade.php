<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NFT Web App | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #0C0032;
            text-decoration: none;
            color: white;
        }

        .card {
            color: white;
        }

        a {
            color: white;
        }

        a:link {
            text-decoration: none;
            color: white;
        }
        
        a:visited {
            text-decoration: none;
            color: white;
        }

        a:hover {
            text-decoration: none;
            color: white;
        }
        
        a:active {
            text-decoration: none;
            color: white;
        }

        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body>
    @if (!(Route::is('login') || Route::is('register')))
    @include('layout.header')
    @endif
    <div class="container">
        @yield('content')
    </div>
    @include('layout.footer')
</body>
</html>
