<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>اطلب واتمنى</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlteRTL/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlteRTL/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/adminlteRTL/dist/css/custom.css') }}">
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script> window.default_locale_lang = "{{ config('app.locale') }}"; </script>
    </head>

    <body class="hold-transition sidebar-mini">
        <div class="wrapper" id='app'>
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav ml-auto">
                    <li>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ session('user')->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/logout">
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>

            {{--  company logo, company name, logged in user name and main sidebar --}}
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="/home" class="brand-link">
                    <div class="row justify-content-center mb-2">
                        <img src="{{ asset('storage/noImage.jpg') }}" alt="AdminLTE Logo" class="rounded-circle img-responsive elevation-3"
                        style="opacity: 1;height:70px;">
                    </div>
                    <div class="row  justify-content-center">
                        <span class="brand-text font-weight-light">@if(config('app.locale', 'en')=='en') Car Wash @else مغلسة سيارات @endif</span>
                    </div>
                    <div class="row  justify-content-center">
                        <span class="brand-text font-weight-light">{{ session('user')->name }}</span>
                    </div>
                </a>

                {{--  main sidebar  --}}
                <div class="sidebar">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item has-treeview {{ url()->current()==url('/tag_setup')?'menu-open':''  }}">
                                <router-link to='/clients' class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Clients
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item has-treeview {{ url()->current()==url('/tag_setup')?'menu-open':''  }}">
                                <router-link to='/expenses' class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Expenses
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item has-treeview {{ url()->current()==url('/monthly_sub')?'menu-open':''  }}">
                                <router-link to='/monthly_sub' class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Monthly Subscriptions
                                    </p>
                                </router-link>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            {{--  router view and progress bar  --}}
            <div class="content-wrapper">
                <div class="content-header" ></div>
                <div class="content" >
                    <router-view></router-view>
                    <vue-progress-bar></vue-progress-bar>
                </div>
            </div>

            <footer class="main-footer"></footer>
        </div>

        <script src="{{asset('vendor/adminlteRTL/plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{asset('vendor/adminlteRTL/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{asset('vendor/adminlteRTL/dist/js/adminlte.min.js') }}"></script>
    </body>
</html>
