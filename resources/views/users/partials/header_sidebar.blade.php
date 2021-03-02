<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> AkokoTakra </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">

    <!-- Datatables Pagination-->
    <link href="{{ URL::to('vendor/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{ URL::to('vendor/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ URL::to('vendor/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Place favicon.ico in the root directory -->
    <link rel="stylesheet" href="{{url('/')}}/assestdash/css/vendor.css">
    <link rel="stylesheet" href="{{url('/')}}/assestdash/css/app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ url('/')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> 


    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
    <!-- Custom css -->
    <link href="{{ URL::to('css/custom.css')}}" rel="stylesheet">

    <!-- Theme initialization -->
    <style>
        .page-item.active .page-link {
            background-color: #0E5D54 !important;
            border-color: #0E5D54 !important;
        }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="app" id="app">
            <header class="header">
                <div class="header-block header-block-collapse d-lg-none d-xl-none">
                    <button class="collapse-btn" id="sidebar-collapse-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                </div>

                {{-- <div class="header-block header-block-search">
                    <form role="search">
                        <div class="input-container">
                            <i class="fa fa-search"></i>
                            <input type="search" placeholder="Search">
                            <div class="underline"></div>
                        </div>
                    </form>
                </div> --}}

                <div class="header-block header-block-nav">
                    <ul class="nav-profile">
                        <li class="notifications new">
                            {{-- <a href="" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <sup>
                                        <span class="counter">8</span>
                                    </sup>
                                </a> --}}


                            {{-- <div class="dropdown-menu notifications-dropdown-menu">
                                <ul class="notifications-container">
                                    <li>
                                        <a href="" class="notification-item">
                                            <div class="img-col">
                                                <div class="img" style="background-image: url('assets/faces/3.jpg')"></div>
                                            </div>
                                            <div class="body-col">
                                                <p>
                                                    <span class="accent">Zack Alien</span> pushed new commit:
                                                    <span class="accent">Fix page load performance issue</span>. </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" class="notification-item">
                                            <div class="img-col">
                                                <div class="img" style="background-image: url('assets/faces/5.jpg')"></div>
                                            </div>
                                            <div class="body-col">
                                                <p>
                                                    <span class="accent">Amaya Hatsumi</span> started new task:
                                                    <span class="accent">Dashboard UI design.</span>. </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="" class="notification-item">
                                            <div class="img-col">
                                                <div class="img" style="background-image: url('assets/faces/8.jpg')"></div>
                                            </div>
                                            <div class="body-col">
                                                <p>
                                                    <span class="accent">Andy Nouman</span> deployed new version of
                                                    <span class="accent">NodeJS REST Api V3</span>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                                <footer>
                                    <ul>
                                        <li>
                                            <a href=""> View All </a>
                                        </li>
                                    </ul>
                                </footer>
                            </div> --}}


                        </li>
                        <li class="profile dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                <div class="img" style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')"> </div>
                                <span class="name"> 
                                     

                                     </span>
                            </a>
                            <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">
{{-- 

                                <a class="dropdown-item" href="#">
                                        <i class="fa fa-user icon"></i> Profile </a>
                                <a class="dropdown-item" href="#">
                                        <i class="fa fa-bell icon"></i> Notifications </a>
                                <a class="dropdown-item" href="#">
                                        <i class="fa fa-gear icon"></i> Settings </a>
                                <div class="dropdown-divider"></div>
                                 --}}

                                <a class="dropdown-item" href="{{route('account.logout')}}">
                                        <i class="fa fa-power-off icon"></i> Logout </a>
                                </div>
                            </li>
                        </ul>
                    </div> 
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                       
                        <div class="sidebar-header">
                             <img src="{{ URL::to('akokotakra-01.png') }}" style="width:100%; height:70px;"/>
                            <div class="brand">
                              
                            </div>
                        </div>
                        <nav class="menu">
                            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                                <li class="active">
                                    <a href="{{route('account.index')}}">
                                        <i class="fa fa-home"></i> Dashboard </a>
                                </li>
                                <li>
                                    <a href="">
                                        <i><img width="30" height="30" src="{{ URL::to('ch_c.png') }}"/></i> Birds
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="{{url('birds/penhouses')}}"> Penhouse </a>
                                        </li>
                                        <li>
                                            <a href="{{url('birds/stock')}}"> Stock </a>
                                        </li>
                                        <li>
                                            <a href="{{url('birds/cyclelist')}}"> Cycle List </a>
                                        </li>
                                        <li>
                                            <a href="{{url('birds/mortality')}}"> Mortality </a>
                                        </li>
                                        <li>
                                            <a href="{{url('birds/drugtaking')}}"> Give Drug </a>
                                        </li>
                                        <li>
                                            <a href="{{url('birds/feedgiven')}}"> Give Feed </a>
                                        </li>
                                        <li>
                                            <a href="{{url('birds/feedwastage')}}"> Feed Wastage </a>
                                        </li>
                                        {{-- <li>
                                            <a href="#"> Search Stock </a>
                                        </li> --}}
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i> <img width="30" height="30" src="{{ URL::to('egg_c.png') }}"/></i> Eggs
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                            <li>
                                                    <a href="{{url('account/collectlist')}}"> Collect </a>
                                                </li>
                                        {{-- <li>
                                            <a href="{{url('account/eggs')}}"> Summary </a>
                                        </li>
                                        <li>
                                            <a href="#"> Search Features </a>
                                        </li> --}}
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                        <i class="fa fa-shopping-cart"></i> Creditors
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="{{url('account/billrecords')}}"> Credit Records  </a>
                                        </li>
                                        <li>
                                            <a href="{{url('account/vendors')}}"> Credtiors </a>
                                        </li>
                                        <li>
                                            <a href="{{route('account.billitems')}}"> Products and Services </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                            <i class="fa fa-area-chart"></i> Sales
                                            <i class="fa arrow"></i>
                                        </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="{{url('account/sales')}}"> Sales Records </a>
                                        </li>
                                        <li>
                                            <a href="{{url('account/customers')}}"> Customers </a>
                                        </li>
                                        <li>
                                            <a href="{{route('account.items')}}"> Products and Services </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="">
                                            <i class="fa fa-file-text-o"></i> Drugs and Feed
                                            <i class="fa arrow"></i>
                                        </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="{{url('account/drugs')}}"> Drugs </a>
                                        </li>
                                        <li>
                                            <a href="{{url('account/feed')}}"> Feed </a>
                                        </li>
                                        {{-- <li>
                                            <a href="#"> FCR </a>
                                        </li> --}}
                                    </ul>
                                </li>
{{-- 

                                <li>
                                    <a href="">
                                            <i class="fa fa-users"></i> Human Resource
                                            <i class="fa arrow"></i>
                                        </a>
                                    <ul class="sidebar-nav">
                                        <li>
                                            <a href="{{url('account/employee')}}"> Employees</a>
                                        </li>
                                        <li>
                                            <a href="{{url('account/payroll')}}"> Payroll </a>
                                        </li>
                                        </a>
                                    </ul>
                                </li> --}}


                                <!-- <li>
                                        <a href="screenful.html">
                                            <i class="fa fa-bar-chart"></i> Agile Metrics
                                            <span class="label label-screenful">by Screenful</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://github.com/modularcode/modular-admin-html">
                                            <i class="fa fa-github-alt"></i> Theme Docs </a>
                                    </li>-->
                               
                                <li>
                                    <a href="">
                                        <i class="fa fa-balance-scale"></i> Accounting
                                        <i class="fa arrow"></i>
                                    </a>
                                    <ul class="sidebar-nav">
                                            <li>
                                                    <a href="{{url('account/chartofaccountlist')}}"> Charts Of Account</a>

                                                    
                                                </li>
                                                <li>
                                                        <a href="{{url('account/journals')}}"> Journals</a>

                                                   
                                                    </li>
                                        <li>
                                            <a href="{{url('account/profitandloss')}}"> Profit and loss</a>

                                        </li>
                                        <li>
                                                <a href="{{url('account/balancesheet')}}"> Balance sheet</a>

                                        </li>
                                        <li>
                                                <a href="{{url('account/trialbalance')}}"> Trial balance</a>
                                        </li>
                                      
                                    </ul>
                                </li>

{{--                                 

                                <li>
                                    <a href="">
                                        <i class="fa fa-file-text-o"></i> Reports
                                        <i class="fa arrow"></i>
                                    </a>
                                <ul class="sidebar-nav">
                                    <li>
                                        <a href="#"> Cash Flow  </a>
                                    </li>
                                    <li>
                                        <a href="#"> Sale Tax </a>
                                    </li>
                                    <li>
                                        <a href="#"> Income by Customers </a>
                                    </li>
                                    <!-- <li>
                                        <a href="#"> Aged R </a>
                                    </li> -->
                                    <li>
                                        <a href="#"> Purchased </a>
                                    </li>
                                    <li>
                                        <a href="#"> Aged Payables </a>
                                    </li>
                                </ul>
                            </li>
 --}}

                        </ul>
                    </nav>
                </div>
                {{--
                <footer class="sidebar-footer">
                    <ul class="sidebar-menu metismenu" id="customize-menu">
                        <li>
                            <ul>
                                <li class="customize">
                                    <div class="customize-item">
                                        <div class="row customize-header">
                                            <div class="col-4"> </div>
                                            <div class="col-4">
                                                <label class="title">fixed</label>
                                            </div>
                                            <div class="col-4">
                                                <label class="title">static</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="title">Sidebar:</label>
                                            </div>
                                            <div class="col-4">
                                                <label>
                                                        <input class="radio" type="radio" name="sidebarPosition" value="sidebar-fixed">
                                                        <span></span>
                                                    </label>
                                            </div>
                                            <div class="col-4">
                                                <label>
                                                        <input class="radio" type="radio" name="sidebarPosition" value="">
                                                        <span></span>
                                                    </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="title">Header:</label>
                                            </div>
                                            <div class="col-4">
                                                <label>
                                                        <input class="radio" type="radio" name="headerPosition" value="header-fixed">
                                                        <span></span>
                                                    </label>
                                            </div>
                                            <div class="col-4">
                                                <label>
                                                        <input class="radio" type="radio" name="headerPosition" value="">
                                                        <span></span>
                                                    </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <label class="title">Footer:</label>
                                            </div>
                                            <div class="col-4">
                                                <label>
                                                        <input class="radio" type="radio" name="footerPosition" value="footer-fixed">
                                                        <span></span>
                                                    </label>
                                            </div>
                                            <div class="col-4">
                                                <label>
                                                        <input class="radio" type="radio" name="footerPosition" value="">
                                                        <span></span>
                                                    </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="customize-item">
                                        <ul class="customize-colors">
                                            <li>
                                                <span class="color-item color-red" data-theme="red"></span>
                                            </li>
                                            <li>
                                                <span class="color-item color-orange" data-theme="orange"></span>
                                            </li>
                                            <li>
                                                <span class="color-item color-green active" data-theme=""></span>
                                            </li>
                                            <li>
                                                <span class="color-item color-seagreen" data-theme="seagreen"></span>
                                            </li>
                                            <li>
                                                <span class="color-item color-blue" data-theme="blue"></span>
                                            </li>
                                            <li>
                                                <span class="color-item color-purple" data-theme="purple"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                            <a href="">
                                    <i class="fa fa-cog"></i> Customize </a>
                        </li>
                    </ul>
                </footer> --}}
            </aside>
            <div class="sidebar-overlay" id="sidebar-overlay"></div>
            <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
            <div class="mobile-menu-handle"></div>



            {{--
            <footer class="footer">
                <div class="footer-block buttons">
                    <iframe class="footer-github-btn" src="https://ghbtns.com/github-btn.html?user=modularcode&repo=modular-admin-html&type=star&count=true"
                        frameborder="0" scrolling="0" width="140px" height="20px"></iframe>
                </div>
                <div class="footer-block author">
                    <ul>
                        <li> created by
                            <a href="https://github.com/modularcode">ModularCode</a>
                        </li>
                        <li>
                            <a href="https://github.com/modularcode/modular-admin-html#get-in-touch">get in touch</a>
                        </li>
                    </ul>
                </div>
            </footer> --}} {{--
            <div class="modal fade" id="modal-media">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Media Library</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    <span class="sr-only">Close</span>
                                </button>
                        </div>
                        <div class="modal-body modal-tab-container">
                            <ul class="nav nav-tabs modal-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link" href="#gallery" data-toggle="tab" role="tab">Gallery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="#upload" data-toggle="tab" role="tab">Upload</a>
                                </li>
                            </ul>
                            <div class="tab-content modal-tab-content">
                                <div class="tab-pane fade" id="gallery" role="tabpanel">
                                    <div class="images-container">
                                        <div class="row"> </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade active in" id="upload" role="tabpanel">
                                    <div class="upload-container">
                                        <div id="dropzone">
                                            <form action="/" method="POST" enctype="multipart/form-data" class="dropzone needsclick dz-clickable" id="demo-upload">
                                                <div class="dz-message-block">
                                                    <div class="dz-message needsclick"> Drop files here or click to upload. </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Insert Selected</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div> --}}
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div class="modal fade" id="confirm-modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                <i class="fa fa-warning"></i> Alert</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure want to do this?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
    </div>
    <!-- Reference block for JS -->
    <div class="ref" id="ref">
        <div class="color-primary"></div>
        <div class="chart">
            <div class="color-primary"></div>
            <div class="color-secondary"></div>
        </div>
    </div>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable();
            responsive: true
        });
</script>

<script src="{{url('/')}}/assestdash/js/vendor.js"></script>
<script src="{{url('/')}}/assestdash/js/app.js"></script>
