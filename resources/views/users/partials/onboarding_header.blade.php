<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AkokoTakra Onboarding</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::to('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ URL::to('vendor/style.css')}}" rel="stylesheet">
    
    <!-- Datatables Pagination-->
    <link href="{{ URL::to('vendor/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ URL::to('vendor/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ URL::to('vendor/css/font-awesome.min.css')}}" rel="stylesheet">
    <style>
        .page-item.active .page-link {
            background-color: #0E5D54 !important;
            border-color: #0E5D54 !important;
        }
        navbar.navbar-expand-lg.navbar-dark.bg-primary.fixed-top{
            height: 50px;
        }
    </style>
</head>
<body>
     <div id="loading-mask">
        <div class="loading-img">
            <img alt="Loading" src="{{ URL::to('vendor/loading.gif') }}" />
        </div>
    </div>
	<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Akoko Takra</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        </div>
    </nav>
</body>

    <script src="{{ URL::to('assestdash/js/app.js')}}"></script>
    
    <!-- Bootstrap core JavaScript -->
    <script src="{{ URL::to('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::to('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- DataTables Pagination -->
    <script src="{{URL::to('vendor/jquery/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::to('vendor/jquery/dataTables.bootstrap4.min.js')}}"></script>



 

 


<script type="text/javascript">
    $(document).ready(function() {
        $('#onboardingDataTable').DataTable();
            responsive: true
        });





</script>