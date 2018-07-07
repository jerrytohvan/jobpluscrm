
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

  <script src="./js/jobplus_app.js"></script>

  <!-- Custom Theme Style -->
  <link href="./css/custom.css" rel="stylesheet">

</head>



  <!-- Navigation-->
  @if(Auth::user()) <!-- USER AUTHENTICATED? -->

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Job Plus CRM</span></a>
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

    <!-- Custom Theme Scripts
    <script src="./js/custom.min.js"></script>-->
      <script src="./js/custom.js"></script>

  </body>
  @else
 <!-- SHOW LOGIN PAGE -->
    @yield('login')
    @yield('content')
  @endif
</html>
