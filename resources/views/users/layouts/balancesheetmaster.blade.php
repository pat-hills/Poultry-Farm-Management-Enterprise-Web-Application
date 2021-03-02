<!doctype html>
<html class="no-js" lang="en"> 
    <body>
        @include('users/partials.header_sidebar')
        <div class="main-wrapper">
            <div class="app" id="app">    
                @yield('balancesheet')
            </div>
        </div>
    </body>    
</html>