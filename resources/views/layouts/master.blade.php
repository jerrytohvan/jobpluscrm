
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="images/favicon.ico" type="image/ico" />

  <title>
    @yield('title')
  </title>

  <!-- Bootstrap -->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="{{ asset('css/gentelella.min.css') }}" rel="stylesheet">

  <!--  dropzone  -->
   <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">

   <!-- NProgress -->
   <link href="{{ asset('css/nprogress.css') }}" rel="stylesheet">
   <!-- icheck -->
   <link href="{{ asset('css/green.css') }}" rel="stylesheet">

   <!-- bootstrap progress bar -->
   <link href="{{ asset('css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">

   <!--  Boostrap Datepick -->
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>

  @stack('stylesheets')

</head>

@if (Auth::check())  <!-- Navigation-->
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">


              @include('includes.sidebar')

              <!-- top navigation -->
              @include('includes.topnav')
              <!-- /top navigation -->

              <!-- page content -->
              @yield('content')
              <!-- /page content -->

              <!-- footer content -->
              @include('includes.footer')
              <!-- /footer content -->
              @yield('bottom_content')
          </div>
        </div>


        <!-- Bootstrap -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!-- fastclick -->
        <script src="{{ asset('js/fastclick.js') }}"></script>

        <!-- NProgress -->
        <script src="{{ asset('js/nprogress.js') }}"></script>

        <!-- Chart.js -->
        <script src="{{ asset('js/Chart.min.js') }}"></script>

        <!-- gauge.js -->
        <script src="{{ asset('js/gauge.min.js') }}"></script>

        <!-- Bootstrap Progressbar -->
        <script src="{{ asset('js/bootstrap-progressbar.min.js') }}"></script>

        <!-- iCheck -->
        <script src="{{ asset('js/icheck.min.js') }}"></script>

        <!-- Skycons -->
        <script src="{{ asset('js/skycons.js') }}"></script>

        <!-- Flot - , pice, time, stack, resize -->
        <script src="{{ asset('js/jquery.flot.js') }}"></script>
        <script src="{{ asset('js/jquery.flot.pie.js') }}"></script>
        <script src="{{ asset('js/jquery.flot.time.js') }}"></script>
        <script src="{{ asset('js/jquery.flot.stack.js') }}"></script>
        <script src="{{ asset('js/jquery.flot.resize.js') }}"></script>


        <!-- flot plugins: jqeury flot orderbars, jquery flow spline, curvedlines -->
        <script src="{{ asset('js/jquery.flot.orderBars.js') }}"></script>
        <script src="{{ asset('js/jquery.flot.spline.min.js') }}"></script>
        <script src="{{ asset('js/curvedLines.js') }}"></script>


        <!-- datejs -->
        <script src="{{ asset('js/date.js') }}"></script>

        <!-- bootstrap-daterangepicker -->
        <script src="{{ asset('js/moment.min.js') }}"></script>
        <script src="{{ asset('js/daterangepicker.js') }}"></script>

        <!-- Jquery Sparkline -->
        <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>

        <!-- Auto Resize Text Area -->
        <script src="{{ asset('js/autosize.min.js') }}"></script>

        <!-- PrettyPrint -->
        <script src="{{ asset('js/prettyPrint.js') }}"></script>

        <!-- jQuery Tags Input
        <script src="{{asset("js/jquery.tagsinput.min.js")}}"></script>
-->

        <!-- bootstrap-fileupload !!!!  http://blueimp.github.io/jQuery-File-Upload/
        <script src="{{asset("js/.js")}}"></script>-->

        <!-- bootstrap-wysihtml5  -->
        <script src="{{ asset('js/bootstrap-wysiwyg.min.js') }}"></script>

        <!-- Dropzone -->
        <script src="{{ asset('js/dropzone.min.js') }}"></script>

        <!-- Custom Theme Scripts -->
        <script src="{{ asset('js/gentelella.min.js') }}"></script>

        @stack('scripts')

  </body>
  <!-- ELSE YIELD LOGIN-->
  @else
    @yield('content')
  @endif
</html>
