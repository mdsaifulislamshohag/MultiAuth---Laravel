<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="{{ $app->name }}" content="{{ $app->details }}">
        <meta name="{{ $app->name }}" content="{{ $app->moto }}">
        <meta name="{{ $app->name }}" content="{{ $app->category }}">
        <meta name="{{ $app->name }}" content="{{ $app->location }}">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        

        <title>{{ $app->name }}</title>

        @if(isset($app->image))
        <link rel="icon" href="{{ asset("images/app/$app->image") }}" type="image/png">
        @else
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
        @endif

        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css')}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
        <script src="{{ asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>



    </head>
    @guest('admin')
    <body class="hold-transition login-page">
    @else
    <body class="hold-transition skin-blue sidebar-mini">
    @endguest

            <div class="wrapper">
                @guest('admin')
                    {{-- Not admin --}}
                @else
                    @include('vendor.multiauth.layouts.topbar')
                    @include('vendor.multiauth.layouts.sidebar')
                

                    <div class="content-wrapper">
                @endguest

                    @yield('content')

                @guest('admin')

                    {{-- Not admin --}}

                @else
                </div>
                    @include('vendor.multiauth.layouts.footer')
                    @include('vendor.multiauth.layouts.control')
                @endguest

            </div>


        <!-- Bootstrap 3.3.6 -->
        <script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('adminlte/plugins/fastclick/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/dist/js/app.min.js') }}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>

        <script src="{{ asset('js/admin.js') }}"></script>
        <script src="{{ asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>

        <!-- jQuery UI 1.11.4 -->
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button);
        </script>
        <script src="{{ asset('js/admin.js') }}"></script>
    
    </body>
</html>