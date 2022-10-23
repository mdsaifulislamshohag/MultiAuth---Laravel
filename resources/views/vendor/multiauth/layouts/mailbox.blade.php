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
        <!-- fullCalendar 2.2.5-->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/fullcalendar/fullcalendar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/fullcalendar/fullcalendar.print.css') }}" media="print">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/flat/blue.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
        <!-- jQuery 2.2.3 -->
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
        <!-- Slimscroll -->
        <script src="{{ asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ asset('adminlte/plugins/fastclick/fastclick.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('adminlte/dist/js/app.min.js') }}"></script>
        <!-- iCheck -->
        <script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>

        <!-- Page Script -->
        <script>
          $(function () {
            //Enable iCheck plugin for checkboxes
            //iCheck for checkbox and radio inputs
            $('.mailbox-messages input[type="checkbox"]').iCheck({
              checkboxClass: 'icheckbox_flat-blue',
              radioClass: 'iradio_flat-blue'
            });

            //Enable check and uncheck all functionality
            $(".checkbox-toggle").click(function () {
              var clicks = $(this).data('clicks');
              if (clicks) {
                //Uncheck all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
              } else {
                //Check all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
              }
              $(this).data("clicks", !clicks);
            });

            //Handle starring for glyphicon and font awesome
            $(".mailbox-star").click(function (e) {
              e.preventDefault();
              //detect type
              var $this = $(this).find("a > i");
              var glyph = $this.hasClass("glyphicon");
              var fa = $this.hasClass("fa");

              //Switch states
              if (glyph) {
                $this.toggleClass("glyphicon-star");
                $this.toggleClass("glyphicon-star-empty");
              }

              if (fa) {
                $this.toggleClass("fa-star");
                $this.toggleClass("fa-star-o");
              }
            });
          });
        </script>
        
        <!-- AdminLTE for demo purposes -->
        <script src="{{ asset('js/admin.js') }}"></script>
        <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    </body>
</html>