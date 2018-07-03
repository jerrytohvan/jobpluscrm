
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
  <link href="./node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="./node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="./node_modules/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="./node_modules/iCheck/skins/flat/green.css" rel="stylesheet">

  <!-- bootstrap-progressbar -->
  <link href="./node_modules/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
  <!-- JQVMap -->
  <link href="./node_modules/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
  <!-- bootstrap-daterangepicker -->
  <link href="./node_modules/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <!-- Animate.css -->
  <link href="./node_modules/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="./css/custom.min.css" rel="stylesheet">

</head>



  <!-- Navigation-->
  @if(Auth::user()) <!-- USER AUTHENTICATED? -->

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>

            <div class="clearfix"></div>
    @include('includes.menu_profile')

    <br />

    @include('includes.sidebar_menu')
    @include('includes.footer_menu')

    </div>
  </div>
  <!-- top navigation -->
  @include('includes.top_nav')
  <!-- /top navigation -->
        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('includes.footer_content')
        <!-- /footer content -->

      </div>
    </div>
    <!-- jQuery -->
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="./node_modules/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="./node_modules/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="./node_modules/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="./node_modules/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="./node_modules/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="./node_modules/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="./node_modules/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="./node_modules/Flot/jquery.flot.js"></script>
    <script src="./node_modules/Flot/jquery.flot.pie.js"></script>
    <script src="./node_modules/Flot/jquery.flot.time.js"></script>
    <script src="./node_modules/Flot/jquery.flot.stack.js"></script>
    <script src="./node_modules/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="./node_modules/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="./node_modules/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="./node_modules/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="./node_modules/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="./node_modules/jqvmap/dist/jquery.vmap.js"></script>
    <script src="./node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="./node_modules/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="./node_modules/moment/min/moment.min.js"></script>
    <script src="./node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="./js/custom.min.js"></script>

  </body>
  @else
 <!-- SHOW LOGIN PAGE -->
    @yield('login')
    @yield('content')
  @endif


</html>
