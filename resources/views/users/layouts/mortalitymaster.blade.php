<!doctype html>
<html class="no-js" lang="en">
    <body>
      @include('users/partials.header_sidebar')
      <div class="main-wrapper">
            <div class="app" id="app">
              @yield('mortality')
            </div>
      </div>
      <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
      {{-- <script src="{{url('/')}}/assestdash/js/custom.js"></script> --}}

       <!-- DataTables Pagination -->
      <script src="{{URL::to('vendor/jquery/jquery.dataTables.min.js')}}"></script>
      <script src="{{URL::to('vendor/jquery/dataTables.bootstrap4.min.js')}}"></script> 

      <script type="text/javascript">
          $(document).ready(function() {
              $('#dataTable').DataTable();
                  responsive: true
              });
      </script>
    </body>
</html>