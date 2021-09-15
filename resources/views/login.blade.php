<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" href="http://abcpaint.com.br/wp-content/uploads/2020/08/cropped-Logotipo_ABCPaint_300x300-1-2-32x32.jpg" sizes="32x32" />
    <title>Jequitiba Comunicação Estratégica - Portal do Administrador</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/monsteradmin/"/>
    <!-- Custom CSS -->
    <link href="/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">
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
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
         style="">
        <div class="auth-box on-sidebar p-4 bg-white m-0" style="top:15% !Important;right: auto !Important; border:1px solid #cdcdcd; height:65% !important;">
            <div id="loginform">
                <div class="logo text-center">
                        <span class="db" style="font-size:40px;width: 300px;"><img src="http://abcpaint.com.br/wp-content/uploads/2020/06/cropped-Logotipo_ABCPaint_300x300-1.jpg"/></span>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        @if(Session::has('errors'))
                            <div class="alert alert-danger w-100 d-lg-block text-left">
                                <strong class="w-100 d-lg-block">Atenção ao seguinte: </strong>
                            </div>
                        @endif
                        @if(Session::has('message'))
                            <div class="alert alert-{{Session::get('message')[0]['type']}} w-100 d-lg-block text-left">
                                <strong class="w-100 d-lg-block">{{Session::get('message')[0]['message']}}</strong>
                            </div>
                            <?php   Session::remove('message'); ?>
                        @endif
                        {!! Form::open(['method'=>'get','route'=>'login.logar','class'=>'form-horizontal mt-3 form-material','id'=>'loginform']) !!}
                        <div class="form-group mb-3">
                            <div class="col-xs-12">
                                {!! Form::text('email',null,['class'=>'form-control '.($errors->has('email') ? 'has-error' : ''),'placeholder'=>'Email']) !!}
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div><br/>
                        <div class="form-group mb-3">
                            <div class="col-xs-12">
                                {!! Form::password('senha',['class'=>'form-control '.($errors->has('senha') ? 'has-error' : ''),'placeholder'=>'Senha']) !!}
                                @if ($errors->has('senha'))
                                    <span class="text-danger">{{ $errors->first('senha') }}</span>
                                @endif
                            </div>
                        </div><br/>
                        <div class="form-group">
                            <div class="d-flex">
                                <div class="checkbox checkbox-info float-left pt-0">
                                    <input id="checkbox-signup" type="checkbox" class="material-inputs chk-col-indigo">
                                    <label for="checkbox-signup"> Lembrar-me </label>
                                </div>
                            </div>
                        </div><br/><br/>
                        <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light">
                            Entrar
                        </button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
<script src="/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
</script>
</body>
</html>