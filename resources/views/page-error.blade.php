<!doctype html>
<html lang="en" >

<head>

    <meta charset="utf-8" />
    <title>SI@DI | ADMIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/dashboard/assets/images/logo_idiomas.png') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/dashboard/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/dashboard/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/dashboard/assets/css/app.min.css') }}" id="app-style"  rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">

                        <div class="card-body">

                            <div class="text-center p-3">

                                <div class="img">
                                    <img src="{{ asset('assets/dashboard/assets/images/error-img.png') }}" class="img-fluid" alt="">
                                </div>

                                <h1 class="error-page mt-5"><span>{{$codigo}}!</span></h1>
                                <h4 class="mb-4 mt-5">{{$titulo}}</h4>
                                <p class="mb-4 w-75 mx-auto">{{$mensaje}}</p>
                                <a class="btn btn-primary mb-4 waves-effect waves-light" href="{{ route('admin.home.index') }}"><i
                                        class="mdi mdi-home"></i> Volver a la página principal</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    {{-- <script src="{{ asset('assets/dashboard/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script> --}}

    {{-- <script src="{{ asset('assets/dashboard/assets/js/app.js') }}"></script> --}}

</body>

</html>