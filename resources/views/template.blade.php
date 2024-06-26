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
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        @stack('css')<!--lo mismo que el section pero aqui lo usan para poner css y js personalizados-->
    </head>
    <body class="sb-nav-fixed">
        <x-navigation-header/>
        <div id="layoutSidenav">
            <x-navigation-menu/>
            <div id="layoutSidenav_content">
                <main>
                    @yield('content')
                </main>
                <x-footer/>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
        @stack('js')
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('js/datatables-simple-demo.js')}}"></script>-->
    </body>
</html>
