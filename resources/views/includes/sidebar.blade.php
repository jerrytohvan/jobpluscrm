
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{ url('/') }}" class="site_title"><i class="fa fa-odnoklassniki"></i> <span>JobPlusCRM</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">

                <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Avatar of {{ Auth::user()->name }}" class="img-circle profile_img">
            </div>

            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
              <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home </span></a></li>
            </li>

            <li><a href="{{ route('social.wall') }}"><i class="fa fa-comments-o"></i>Announcements</a>
            </li>
              <li><a><i class="fa fa-edit"></i> Companies <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{ route('companies.fulllist') }}">Full List</a></li>
                  <li><a href="{{ route('companies.new') }}">New</a></li>
                    </ul>
              </li>
              <li><a><i class="fa fa-desktop"></i> Accounts <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{ route('accounts.fulllist') }}">Full List</a></li>
                  <li><a href="{{ route('accounts.new') }}">New</a></li>
                </ul>
              </li>
            </li>
            @if(Auth::user()->admin == 1)
            <li><a href="{{ route('index.register') }}"><i class="fa fa-users"></i>Manage Admin</a>
            </li>
            @endif
            <li><a href="{{ route('index.mail') }}"><i class="fa fa-envelope-o"></i>Mail</a>
            </li>
            <!-- <li><a href="{{ route('index.calendar') }}"><i class="fa fa-calendar"></i>Calendar</a> -->
            </li>
            <li><a href="{{ route('index.event') }}"><i class="fa fa-clock-o"></i>Tasks</a>
            </li>
              <li><a><i class="fa fa-desktop"></i> Candidates <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{ route('accounts.fulllist') }}">Full list</a></li>
                  <li><a href="{{ route('accounts.new') }}">New</a></li>
                </ul>
              <!-- <li><a href="{{ route('data.presentation') }}"><i class="fa fa-table"></i> Data Presentation</a> -->
              </li>
              <li><a href="{{ route('index.smart.match') }}"><i class="fa fa-magic"></i> Smart Match </a>
              </li>
              <!-- <li><a href="{{ route('settings') }}"><i class="fa fa-bar-chart-o"></i> Telegram</a></li> -->

            </ul>
          </div>


        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
          <a data-toggle="tooltip" data-placement="top" title="Settings">
            <!-- <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> -->
          </a>
          <a data-toggle="tooltip" data-placement="top" title="FullScreen">
            <!-- <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span> -->
          </a>
          <a data-toggle="tooltip" data-placement="top" title="Lock">
            <!-- <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span> -->
          </a>
          <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{ route('logout') }}">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
          </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
