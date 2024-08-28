<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link href="{{ asset('loginn/logoveterinaria.png') }}" rel="icon" type="image/png">

    <!-- title and description-->
    <title>ADMIN - DOG CENTER</title>
    <meta name="description" content="Socialite - Social sharing network HTML Template">

    <!-- css files -->
    <link rel="stylesheet" href="{{ asset('loginn/assets/css/tailwind.css') }}">
    <link rel="stylesheet" href="{{ asset('loginn/assets/css/style.css') }}">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

</head>

<body>

    <div class="sm:flex">

        <div style="background: #000000;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #4ed17a, #06e239);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #4ed17a, #06e239); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        "
            class="relative lg:w-[580px] md:w-96 w-full p-10 min-h-screen bg-white shadow-xl flex items-center pt-10 dark:bg-slate-900 z-10">

            <div class="w-full lg:max-w-sm mx-auto space-y-10"
                uk-scrollspy="target: > *; cls: uk-animation-scale-up; delay: 100 ;repeat: true">

                <!-- logo image-->
                <a href="#"> <img src="{{ asset('logo_nuevo.png') }}"
                        class="w-28 absolute top-10 left-10 dark:hidden" alt=""></a>
                <a href="#"> <img src="{{ asset('logo_nuevo.png') }}"
                        class="w-28 absolute top-10 left-10 hidden dark:!block" alt=""></a>
 
                <!-- logo icon optional -->
                <div class="hidden">
                    <img class="w-12" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&amp;shade=600"
                        alt="Socialite html template">
                </div>

                <!-- title -->
                <h2  class="text-2xl font-semibold mb-1.5 text-blue-700" >
                    Iniciar sesión en su cuenta </h2>
                <div >
                    
                       
                    {{-- <p class="text-sm text-gray-700 font-normal">If you haven’t signed up yet. <a href="form-register.html" class="text-blue-700">Register here!</a></p> --}}
                </div>


                <!-- form -->
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li style="color: red">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success mb-4">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}"
                    class="space-y-7 text-sm text-black font-medium dark:text-white">
                    @csrf
                    <!-- email -->
                    <div>
                        <label for="email" class="">Email:</label>
                        <div class="mt-2.5">
                            <input id="email" type="email" name="email" :value="old('email')" required
                                autofocus autocomplete="username" placeholder="Ingrese su email ..." required=""
                                class="!w-full !rounded-lg !bg-transparent !shadow-sm !border-slate-200 dark:!border-slate-800 dark:!bg-white/5 ">
                        </div>
                    </div>
                    <!-- password -->
                    <div>
                        <label for="email" class="">Contraseña:</label>
                        <div class="mt-2.5">
                            <input id="password" type="password" name="password" required
                                autocomplete="current-password" placeholder="Ingrese su contraseña ..."
                                class="!w-full !rounded-lg !bg-transparent !shadow-sm !border-slate-200 dark:!border-slate-800 dark:!bg-white/5">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">

                        <div class="flex items-center gap-2.5">
                            <input id="rememberme" name="rememberme" type="checkbox">
                            <label for="rememberme" class="font-normal">Acuérdate de mí</label>
                        </div>
                        <a href="{{ route('password.request') }}" class="text-blue-700">Has olvidado tu contraseña </a>
                    </div>

                    <!-- submit button -->
                    <div>
                        <button type="submit" class="button  bg-black text-white w-full">
                            Iniciar sesión</button>
                    </div>

                    {{-- <div class="text-center flex items-center gap-6"> 
            <hr class="flex-1 border-slate-200 dark:border-slate-800"> 
            Or continue with  
            <hr class="flex-1 border-slate-200 dark:border-slate-800">
          </div> 

          <!-- social login -->
          <div class="flex gap-2" uk-scrollspy="target: > *; cls: uk-animation-scale-up; delay: 400 ;repeat: true">
            <a href="#" class="button flex-1 flex items-center gap-2 bg-primary text-white text-sm"> <ion-icon name="logo-facebook" class="text-lg"></ion-icon> facebook  </a>
            <a href="#" class="button flex-1 flex items-center gap-2 bg-sky-600 text-white text-sm"> <ion-icon name="logo-twitter"></ion-icon> twitter  </a>
            <a href="#" class="button flex-1 flex items-center gap-2 bg-black text-white text-sm"> <ion-icon name="logo-github"></ion-icon> github  </a>
          </div> --}}
                    <div class="mt-5 text-center">
                        {{-- <p>Don't have an account ? <a href="pages-register.html" class="fw-medium text-primary">
                    Signup
                    now </a> </p> --}}
                        <p>©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> By. Navi<i class="mdi mdi-heart text-danger"></i>


                        </p>
                    </div>
                </form>


            </div>

        </div>

        <!-- image slider -->
        <div class="flex-1 relative bg-primary max-md:hidden">


            <div class="relative w-full h-full" tabindex="-1" uk-slideshow="animation: slide; autoplay: true">

                <ul class="uk-slideshow-items w-full h-full">
                    <li class="w-full">
                        <img src="https://scontent.flpb2-2.fna.fbcdn.net/v/t39.30808-6/425708114_860988159370916_8812697490188556778_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=783fdb&_nc_ohc=ubhc_BRLS9MAX-DmXLW&_nc_ht=scontent.flpb2-2.fna&oh=00_AfB_D4ckio2ZIiZyxv3OMy1AHO0_FogGnOl5ifSJ7ttacg&oe=65E7197B" alt=""
                            class="w-full h-full object-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
                        <div class="absolute bottom-0 w-full uk-tr ansition-slide-bottom-small z-10">
                            <div class="max-w-xl w-full mx-auto pb-32 px-5 z-30 relative"
                                uk-scrollspy="target: > *; cls: uk-animation-scale-up; delay: 100 ;repeat: true">
                                <img class="w-12" src="{{ asset('loginn/logoveterinaria.png') }}"
                                    alt="Socialite html template">
                                <h4 class="!text-white text-2xl font-semibold mt-7" uk-slideshow-parallax="y: 600,0,0">
                                    DOG CENTER </h4>
                                <p class="!text-white text-lg mt-7 leading-8" uk-slideshow-parallax="y: 800,0,0;"> "En
                                    nuestras manos, tu mascota encontrará amor y cuidado."</p>
                            </div>
                        </div>
                        <div class="w-full h-96 bg-gradient-to-t from-black absolute bottom-0 left-0"></div>
                    </li>
                    <li class="w-full">
                        <img src="https://media.istockphoto.com/id/1171733307/es/foto/veterinario-con-perro-y-gato-cachorro-y-gatito-en-el-m%C3%A9dico.jpg?s=612x612&w=0&k=20&c=v08DSeFqYx2_VGucKz5AxeC0ZEP5B1IBfBVWotHYF3s="
                            alt=""
                            class="w-full h-full object-cover uk-animation-kenburns uk-animation-reverse uk-transform-origin-center-left">
                        <div class="absolute bottom-0 w-full uk-tr ansition-slide-bottom-small z-10">
                            <div class="max-w-xl w-full mx-auto pb-32 px-5 z-30 relative"
                                uk-scrollspy="target: > *; cls: uk-animation-scale-up; delay: 100 ;repeat: true">
                                <img class="w-12" src="{{ asset('loginn/logoveterinaria.png') }}"
                                    alt="Socialite html template">
                                <h4 class="!text-white text-2xl font-semibold mt-7"
                                    uk-slideshow-parallax="y: 800,0,0"> DOG CENTER</h4>
                                <p class="!text-white text-lg mt-7 leading-8" uk-slideshow-parallax="y: 800,0,0;">
                                    "Cuidando el bienestar de tu mejor amigo, porque cada mascota merece lo mejor."</p>
                            </div>
                        </div>
                        <div class="w-full h-96 bg-gradient-to-t from-black absolute bottom-0 left-0"></div>
                    </li>
                </ul>

                <!-- slide nav -->
                <div class="flex justify-center">
                    <ul
                        class="inline-flex flex-wrap justify-center  absolute bottom-8 gap-1.5 uk-dotnav uk-slideshow-nav">
                    </ul>
                </div>


            </div>


        </div>

    </div>


    <!-- Uikit js you can use cdn  https://getuikit.com/docs/installation  or fine the latest  https://getuikit.com/docs/installation -->
    <script src="{{ asset('loginn/assets/js/uikit.min.js') }}"></script>
    <script src="{{ asset('loginn/assets/js/script.js') }}"></script>

    <!-- Ion icon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- Dark mode -->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }

        // Whenever the user explicitly chooses light mode
        localStorage.theme = 'light'

        // Whenever the user explicitly chooses dark mode
        localStorage.theme = 'dark'

        // Whenever the user explicitly chooses to respect the OS preference
        localStorage.removeItem('theme')
    </script>

</body>

</html>
