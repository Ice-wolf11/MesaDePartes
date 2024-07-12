<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="Mesa De Partes Pedro p. Diaz" />
        <meta name="author" content="Team Feder" />
        <title>Mesa De Partes - @yield('title')</title>
        <!--<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />-->
        <link href="{{asset('css/template.css')}}" rel="stylesheet" />
        <link href="{{asset('css/style.css')}}" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        @stack('css')<!--lo mismo que el section pero aqui lo usan para poner css y js personalizados-->
        @stack('js')
    </head>
    <body>
        <main>
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <!-- Navbar Brand-->
                <img class="logo" src="{{asset('assets/img/logoppd2018.png')}}" alt="">
                <a class="navbar-brand ps-3" href="{{route('index')}}">Mesa De Partes</a>
                <!-- Sidebar Toggle-->
                <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" action="{{route('login')}}" method="get">
                    <button class="btn btn-primary" type="submit">Iniciar sesión</button>
                </form>
            </nav>
            @yield('content')
        </main>
        <script src="{{asset('js/envioDatos-tramites.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="{{asset('js/formularios.js')}}" crossorigin="anonymous"></script>  
    </body>