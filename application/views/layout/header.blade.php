<!DOCTYPE html>
<!--[if IE 8]>      <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

  <head>
    <title>Permiss - Instructor</title>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="/css/normalize.css" />
    <link rel="stylesheet" href="/css/foundation.css" />
    <script src="/js/vendor/custom.modernizr.js"></script>
    <script src="/js/jquery.min.js"></script>

    @yield('head')

    <link rel="stylesheet" href="/css/kyle.css" />

  </head>
  <body>

        <nav class="top-bar">
          <ul class="title-area">
            <!-- Title Area -->
            <li class="name">
              <h1><a href="/">Permiss</a></h1>
            </li>
            <li class="toggle-topbar menu-icon"><a href="#"></a></li>
          </ul>

          <section class="top-bar-section">
            <!-- Left Nav Section -->
            <ul class="left">
              <li class="divider"></li>
              @if(Session::get('role') === 'instructor')
                <li>
                  <a href="/instructor">View Courses</a>
                </li>
                <li>
                  <a href="/instructor/add_course">Add Course</a>
                </li>
              @elseif(Session::get('role') === 'student')
                <li>
                  <a href="/student">View Requests</a>
                </li>
                <li>
                  <a href="/student/request">Request Course</a>
                </li>
              @endif
            </ul>

            <!-- Right Nav Section -->
            <ul class="right" style="background:black;">
              <li style="margin-right: 10px;">
                <a href="/logout" class="button alert">Logout</a>
              </li>
            </ul>
          </section>
        </nav>

    <div class="content">
      @yield('content')
    </div>
    
     
  <script src="/js/foundation.min.js"></script>
  </body>
</html>
