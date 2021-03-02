<!doctype html>
<html class="no-js" lang="en">
    <link  href="{{ URL::to('css/penstyle.css')}}" rel="stylesheet">
    <body>
      @include('users/partials.onboarding_header')
      <div class="main-wrapper">
            @yield('penhouse')
      </div>
    </body>
</html>