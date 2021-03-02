<!doctype html>
<html class="no-js" lang="en">
    <body>
      @include('users/partials.header_sidebar')
      <div class="main-wrapper">
            <div class="app" id="app">
              @yield('customer')
            </div>
      </div>
       <!-- DataTables Pagination -->
        <script src="{{URL::to('vendor/jquery/jquery.dataTables.min.js')}}"></script>
        <script src="{{URL::to('vendor/jquery/dataTables.bootstrap4.min.js')}}"></script> 
        <script type="text/javascript">
            $(document).ready(function() {
                $('#customerTable').DataTable();
                    responsive: true
                });
        </script>
    </body>
</html>