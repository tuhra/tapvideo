<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>TAP TUBE</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/skins/_all-skins.min.css')}}">

    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/iCheck/all.css') }}">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- jQuery 3 -->
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.1/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>

    @yield('css')
</head>

<body class="skin-blue sidebar-mini">
@if (!Auth::guest())
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="#" class="logo">
                <b>Tap Tube</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ asset('/images/user.png') }}"
                                     class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! Auth::user()->name !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ asset('/images/user.png') }}"
                                         class="img-circle" alt="User Image"/>
                                    <p>
                                        {!! Auth::user()->name !!}
                                        <small>Member since {!! Auth::user()->created_at->format('M. Y') !!}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                    </div>
                                    <div class="pull-right">
                                        <form action="{{ asset('admin/logout') }}" method="POST">
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-default">Sign out</button>
                                        </form>
                                        <!-- <a href="{!! asset('/logout') !!}" class="btn btn-default btn-flat">Sign out</a> -->
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('admin.layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            <strong>Copyright Â© 2016 <a href="#">Company</a>.</strong> All rights reserved.
        </footer>

    </div>
@else
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{!! asset('/') !!}">
                    Bee Shop
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{!! asset('/home') !!}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <li><a href="{!! asset('/login') !!}">Login</a></li>
                    <li><a href="{!! asset('/register') !!}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif

    @include('admin.layouts.footer')

    
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- Morris.js charts -->
    <script src="{{ asset('bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('bower_components/morris.js/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>

    <script src="{{ asset('bower_components/chart.js/Chart.js') }}"></script>

    <!-- FastClick -->
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- jQuery Knob Chart -->
    <script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>

    <script src="{{ asset('bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('bower_components/admin-lte/dist/js/pages/dashboard.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('bower_components/admin-lte/dist/js/demo.js')}}"></script>

    <script src="{{ asset('bower_components/admin-lte/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
    <script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.1/js/star-rating.js" type="text/javascript"></script>
    <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('bower_components/admin-lte/app.js')}}"></script>
    <script src="{{ asset('bower_components/select2/dist/js/select2.min.js')}}"></script>
    
    <script>

        jQuery(document).ready(function () {

            $(document).on('show.bs.modal','#deleteMediaModal', function (e) {
                var button = $(e.relatedTarget);
                $('#delete_id').val(button.data('id'));
                var url = '<?php echo asset("admin/media") ?>' + '/' + button.data('id');
                $('#deleteMediaFormAction').attr('action', url);
            })

            $(document).on('show.bs.modal','#deleteFormModal', function (e) {
                var button = $(e.relatedTarget);
                $('#delete_id').val(button.data('id'));
                var url = button.data('url');
                $('#deleteFormAction').attr('action', url);
            })

            $('#promotion_product').show();

            
            $('.alert').delay(3000).hide(0); 
            $('#parent').select2();
            $('#base_location').select2();

            $('#warehouse_country').select2();
            $('#warehouse_state').select2();
            $('#warehouse_region').select2();
            $('#warehouse_township').select2();

            $('#business_country').select2();
            $('#business_state').select2();
            $('#business_region').select2();
            $('#business_township').select2();

            $('#return_country').select2();
            $('#return_state').select2();
            $('#return_region').select2();
            $('#return_township').select2();

            $('#id_type').select2();
            $('#bank_id').select2();
            $('#bank_account_type').select2();

            $('#category').select2();
            $('#sub_category').select2();
            $('#brand').select2();
            $('#user_id').select2();
            $('#product_id').select2();
            $('#promotion_type').select2();
            $('#merchant_id').select2();
            $('#nrc_prefix').select2();
            $('#currency').select2();
            $('#bank_type').select2();
            // $('#status').select2();

            $('#product_rating').rating({
                min: 0,
                max: 5,
                step: 1,
                size: 'sm'
            });

            $('.clear-rating clear-rating-active').hide();

            $('#from_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            })

            $('#end_date').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            })

            $(document).on('change', '#promotion_type', function () {
                if (this.value === 'Line') {
                    $('#promotion_product').hide();
                } else {
                    $('#promotion_product').show();
                }
            })
        });
        

        function validateNumber(evt) {
            var theEvent = evt || window.event;

            // Handle paste
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
            // Handle key press
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            var regex = /[0-9]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
    
    </script>
    </body>
    </html>

    @yield('scripts')
</body>
</html>



