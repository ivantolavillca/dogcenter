<!doctype html>
<html lang="es">

<head>

    <meta charset="utf-8" />
    <title>LOGIN | SI@DI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/dashboard/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/dashboard/assets/css/icons.min.css" rel="stylesheet') }}" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/dashboard/assets/css/app.min.css') }}" id="app-style" rel="stylesheet"
        type="text/css" />

</head>

<body>
    <div class="home-btn d-none d-sm-block">
        <a href="index.html" class="text-reset"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-login text-center">
                            <div class="bg-login-overlay"></div>
                            <div class="position-relative">
                                <h5 class="text-white font-size-20">Bienvenido!</h5>
                                <p class="text-white-50 mb-0">Si@di - DEPARTAMENTO DE IDIOMAS.</p>
                                <a href="/" class="logo logo-admin mt-4">
                                    <img src="{{ asset('assets/dashboard/assets/images/upea2.png') }}" alt=""
                                        height="30">
                                </a>
                            </div>

                        </div>
                        <div class="card-body pt-5">

                            <div class="p-2">
                                <div class="p-2">
                                    @if ($errors->any())
                                        <div class="alert alert-danger mb-4">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (session('status'))
                                        <div class="alert alert-success mb-4">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label" for="username">{{ __('Email') }}</label>
                                            <x-input id="email" class="form-control" type="email" name="email"
                                                :value="old('email')" required autofocus autocomplete="username" />
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="userpassword">{{ __('Password') }}</label>
                                            <x-input id="password" class="form-control" type="password" name="password"
                                                required autocomplete="current-password" />
                                        </div>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customControlInline"
                                                name="remember" />
                                            <label class="form-check-label"
                                                for="customControlInline">{{ __('Remember me') }}</label>
                                        </div>

                                        <div class="mt-3">
                                            <x-button class="btn btn-primary w-100 waves-effect waves-light"
                                                type="submit">{{ __('ACCEDER') }}</x-button>
                                        </div>

                                        <div class="mt-4 text-center">
                                            @if (Route::has('password.request'))
                                                <a href="{{ route('password.request') }}" class="text-muted"><i
                                                        class="mdi mdi-lock me-1"></i>
                                                    {{ __('Forgot your password?') }}</a>
                                            @endif
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            {{-- <p>Don't have an account ? <a href="pages-register.html" class="fw-medium text-primary">
                                    Signup
                                    now </a> </p> --}}
                            <p>©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> By. Navi - Universidad Pública de El Alto<i class="mdi mdi-heart text-danger"></i>
                                
                                - S.I.E.
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- JAVASCRIPT -->
        <!-- JAVASCRIPT --> 
        <script src="{{ asset('assets/dashboard/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/dashboard/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/dashboard/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/dashboard/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/dashboard/assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

        <script src="{{ asset('assets/dashboard/assets/js/app.js') }}"></script>

</body>

</html>
