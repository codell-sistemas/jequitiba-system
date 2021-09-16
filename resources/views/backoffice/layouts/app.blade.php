<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon"
          href="http://abcpaint.com.br/wp-content/uploads/2020/08/cropped-Logotipo_ABCPaint_300x300-1-2-32x32.jpg"
          sizes="32x32"/>

    <title>Jequitiba Comunicação - Área Administrativa | @yield('title')</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/xtremeadmin/"/>
    <link href="/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="/dist/js/pages/chartist/chartist-init.css" rel="stylesheet">
    <link href="/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="/assets/libs/c3/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/dist/css/style.min.css" rel="stylesheet">
    <link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">

            <div class="navbar-header" data-logobg="skin1" style="background: #1b3b6a;">
                <!-- This is for the sidebar toggle which is visible on mobile only -->
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <a class="navbar-brand" href="/">
                    <!-- Logo icon -->
                    <b class="logo-icon">
                        <img src="/img/logo.png" style="width: 30px;"/>
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span class="logo-text">
                       <strong>Jequitiba</strong>
                        </span>
                </a>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Toggle which is visible on mobile only -->
                <!-- ============================================================== -->
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                   data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                   aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>


            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <div class="navbar-collapse collapse" id="navbarSupportedContent" style="background: #1b3b6a;">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto float-left">
                    <!-- This is  -->
                    <li class="nav-item"><a
                                class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark"
                                href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                    <!-- ============================================================== -->
                </ul>
                <!-- ============================================================== -->
                <!-- Right side toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav float-right">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user profile-pic rounded-circle" style="width:30px;"></i>
                        </a>
                        <div class="dropdown-menu mailbox dropdown-menu-right scale-up">
                            <ul class="dropdown-user list-style-none">
                                <li>
                                    <div class="dw-user-box p-3 d-flex">
                                        <div class="u-img"><img src="/img/user.png" style="width:50px;"/></div>
                                        <div class="u-text ml-2">
                                            <h4 class="mb-0">{{\Auth::user()->nome}}</h4>
                                            <p class="text-muted mb-1 font-14">{{\Auth::user()->email}}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="user-list"><a class="px-3 py-2" href="{{route('login.logout')}}"><i
                                                class="fa fa-power-off"></i>
                                        Sair</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
        @include('backoffice.layouts.sidebar')
        <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
        <!-- End Bottom points-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">@yield('menu')</h3>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">@yield('menu')</li>
                </ol>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- CONTENT -->
        <div class="container-fluid">
            @if(Session::has('message'))
                <div class="alert alert-{{Session::get('message')[0]['type']}} w-100 d-lg-block text-left">
                    <strong class="w-100 d-lg-block">{!! Session::get('message')[0]['message'] !!}</strong>
                </div>
                <?php   Session::remove('message'); ?>
            @endif
        <!-- end:: Content Head -->
            @if(Session::has('errors'))
                <div class="alert alert-danger w-100 d-lg-block">
                    <strong class="w-100 d-lg-block">Atenção ao seguinte: </strong>
                    <hr/>
                    @foreach(Session::get('errors')->messages() as $error)
                        @foreach($error as $message)
                            <span>{{$message}}</span><br/>
                        @endforeach
                    @endforeach
                </div>
            @endif

            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                        Session::forget('success');
                    @endphp
                </div>
            @endif
            @yield('content')
        </div>
        <footer class="footer">
            © {{date('Y')}} ABCPaint.com.br
        </footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
<script src="/assets/libs/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="/js/select2.min.js"></script>

<link rel="stylesheet" href="/css/select2.css"/>
<!-- Bootstrap tether Core JavaScript -->
<script src="/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- PAGE SCRIPT -->
@yield('scripts')
<script src="/dist/js/jquery.mask.js"></script>
<script src="/dist/js/cidades-estados.js"></script>
<script src="/dist/js/geral.js"></script>
<!----------------->
<!-- apps -->
<script src="/dist/js/app.min.js"></script>
<script src="/dist/js/app.init.js"></script>
<script src="/dist/js/app-style-switcher.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="/dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- chartist chart -->
<script src="/assets/libs/chartist/dist/chartist.min.js"></script>
<script src="/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<!--c3 JavaScript -->
<script src="/assets/libs/d3/dist/d3.min.js"></script>
<script src="/assets/libs/c3/c3.min.js"></script>
<script>
    $(function () {
        $('body').on('change', '.cep', function () {
            $.get('/cep', {'term': $(this).val()}, function (data) {
                $('#endereco').val(data.logradouro);
                $('#bairro').val(data.bairro);
                $('#uf').val(data.uf);
                $('#cidade').val(data.localidade);
            }, 'json');
        });
    });
</script>

</body>

</html>
