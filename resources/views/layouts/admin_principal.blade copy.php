<!DOCTYPE html>
<!-- Template Name: DashCode - HTML, React, Vue, Tailwind Admin Dashboard Template Author: Codeshaper Website: https://codeshaper.net Contact: support@codeshaperbd.net Like: https://www.facebook.com/Codeshaperbd Purchase: https://themeforest.net/item/dashcode-admin-dashboard-template/42600453 License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project. -->
<html lang="zxx" dir="ltr" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>Dashcode - HTML Template</title>
    <link rel="icon" type="image/png" href="assets/images/logo/favicon.svg">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="{{ asset('assets/temp2/assets/css/rt-plugins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/temp2/assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/alertas/sweetalert2.min.css') }}">
    <!-- End : Theme CSS-->
    <script src="{{ asset('assets/temp2/assets/js/settings.js') }}" sync></script>
    @livewireStyles
    @livewireScripts
    @vite(['resources/js/app.js'])
</head>

<body class=" font-inter dashcode-app" id="body_class">
    <!-- [if IE]> <p class="browserupgrade"> You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security. </p> <![endif] -->
    <main class="app-wrapper">
        <!-- BEGIN: Sidebar -->
        <!-- BEGIN: Sidebar -->
        <div class="sidebar-wrapper group">
            <div id="bodyOverlay"
                class="w-screen h-screen fixed top-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm z-10 hidden"></div>
            <div class="logo-segment">
                <a class="flex items-center" href="index.html">
                    <img src="{{ asset('assets/temp2/assets/images/logo/logo-c.svg') }}" class="black_logo" alt="logo">
                    <img src="{{ asset('assets/temp2/assets/images/logo/logo-c-white.svg')}}" class="white_logo" alt="logo">
                   
                    <span
                        class="ltr:ml-3 rtl:mr-3 text-xl font-Inter font-bold text-slate-900 dark:text-white">SI@DI  v3.0</span>
                </a>
                <!-- Sidebar Type Button -->
                <div id="sidebar_type" class="cursor-pointer text-slate-900 dark:text-white text-lg">
                    <span class="sidebarDotIcon extend-icon cursor-pointer text-slate-900 dark:text-white text-2xl">
                        <div
                            class="h-4 w-4 border-[1.5px] border-slate-900 dark:border-slate-700 rounded-full transition-all duration-150 ring-2 ring-inset ring-offset-4 ring-black-900 dark:ring-slate-400 bg-slate-900 dark:bg-slate-400 dark:ring-offset-slate-700">
                        </div>
                    </span>
                    <span class="sidebarDotIcon collapsed-icon cursor-pointer text-slate-900 dark:text-white text-2xl">
                        <div
                            class="h-4 w-4 border-[1.5px] border-slate-900 dark:border-slate-700 rounded-full transition-all duration-150">
                        </div>
                    </span>
                </div>
                <button class="sidebarCloseIcon text-2xl">
                    <iconify-icon class="text-slate-900 dark:text-slate-200" icon="clarity:window-close-line">
                    </iconify-icon>
                </button>
            </div>
            <div id="nav_shadow"
                class="nav_shadow h-[60px] absolute top-[80px] nav-shadow z-[1] w-full transition-all duration-200 pointer-events-none
      opacity-0">
            </div>



            @include('layouts.slider')


            
        </div>
       

        <!-- End: Settings -->
        <div class="flex flex-col justify-between min-h-screen">
            <div>
             
                <div class="z-[9]" id="app_header">
                    <div
                        class="app-header z-[999] ltr:ml-[248px] rtl:mr-[248px] bg-white dark:bg-slate-800 shadow-sm dark:shadow-slate-700">
                        <div class="flex justify-between items-center h-full">
                            <div
                                class="flex items-center md:space-x-4 space-x-2 xl:space-x-0 rtl:space-x-reverse vertical-box">
                                <a href="index.html" class="mobile-logo xl:hidden inline-block">
                                    <img src="{{ asset('assets/temp2/assets/images/logo/logo-c.svg') }}" class="black_logo" alt="logo">
                                    <img src="{{ asset('assets/temp2/assets/images/logo/logo-c-white.svg')}}" class="white_logo" alt="logo">
                                </a>
                                <button class="smallDeviceMenuController hidden md:inline-block xl:hidden">
                                    <iconify-icon
                                        class="leading-none bg-transparent relative text-xl top-[2px] text-slate-900 dark:text-white"
                                        icon="heroicons-outline:menu-alt-3"></iconify-icon>
                                </button>
                                

                            </div>
                            <!-- end vertcial -->
                            <div class="items-center space-x-4 rtl:space-x-reverse horizental-box">
                                <a href="index.html">
                                    <span class="xl:inline-block hidden">
                                        <img src="{{ asset('assets/temp2/assets/images/logo/logo.svg')}}" class="black_logo " alt="logo">
                                        <img src="{{ asset('assets/temp2/assets/images/logo/logo-white.svg')}}" class="white_logo"
                                            alt="logo">
                                    </span>
                                    <span class="xl:hidden inline-block">
                                        <img src="{{ asset('assets/temp2/assets/images/logo/logo-c.svg')}}" class="black_logo " alt="logo">
                                        <img src="{{ asset('assets/temp2/assets/images/logo/logo-c-white.svg')}}" class="white_logo "
                                            alt="logo">
                                    </span>
                                </a>
                                <button
                                    class="smallDeviceMenuController  open-sdiebar-controller xl:hidden inline-block">
                                    <iconify-icon
                                        class="leading-none bg-transparent relative text-xl top-[2px] text-slate-900 dark:text-white"
                                        icon="heroicons-outline:menu-alt-3"></iconify-icon>
                                </button>

                            </div>
                            <!-- end horizental -->



                            <div class="main-menu">
                                <ul>

                                    <li class="  menu-item-has-children  ">
                                        <!--  Single menu -->

                                        <!-- has dropdown -->



                                        <a href="javascript:void()">
                                            <div class="flex flex-1 items-center space-x-[6px] rtl:space-x-reverse">
                                                <span class="icon-box">
                                                    <iconify-icon icon=heroicons-outline:home> </iconify-icon>
                                                </span>
                                                <div class="text-box">Dashboard</div>
                                            </div>
                                            <div
                                                class="flex-none text-sm ltr:ml-3 rtl:mr-3 leading-[1] relative top-1">
                                                <iconify-icon icon="heroicons-outline:chevron-down"> </iconify-icon>
                                            </div>
                                        </a>

                                        <!-- Dropdown menu -->



                                        <ul class="sub-menu">



                                            <li>
                                                <a href=index.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons:presentation-chart-line
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Analytics Dashboard
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=ecommerce-dashboard.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons:shopping-cart
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Ecommerce Dashboard
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=project-dashboard.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons:briefcase
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Project Dashboard
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=crm-dashboard.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=ri:customer-service-2-fill
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            CRM Dashboard
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=banking-dashboard.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons:wrench-screwdriver
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Banking Dashboard
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>

                                        </ul>

                                        <!-- Megamenu -->


                                    </li>

                                    <li class="  menu-item-has-children  ">
                                        <!--  Single menu -->

                                        <!-- has dropdown -->



                                        <a href="javascript:void()">
                                            <div class="flex flex-1 items-center space-x-[6px] rtl:space-x-reverse">
                                                <span class="icon-box">
                                                    <iconify-icon icon=heroicons-outline:chip> </iconify-icon>
                                                </span>
                                                <div class="text-box">App</div>
                                            </div>
                                            <div
                                                class="flex-none text-sm ltr:ml-3 rtl:mr-3 leading-[1] relative top-1">
                                                <iconify-icon icon="heroicons-outline:chevron-down"> </iconify-icon>
                                            </div>
                                        </a>

                                        <!-- Dropdown menu -->



                                        <ul class="sub-menu">



                                            <li>
                                                <a href=chat.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:chat
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Chat
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=email.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:mail
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Email
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=calender>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:calendar
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Calendar
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=kanban>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:view-boards
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Kanban
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=todo>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:clipboard-check
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Todo
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=projects>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:document
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Projects
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>

                                        </ul>

                                        <!-- Megamenu -->


                                    </li>

                                    <li class=" menu-item-has-children has-megamenu  ">
                                        <!--  Single menu -->

                                        <!-- has dropdown -->



                                        <a href="javascript:void()">
                                            <div class="flex flex-1 items-center space-x-[6px] rtl:space-x-reverse">
                                                <span class="icon-box">
                                                    <iconify-icon icon=heroicons-outline:view-boards> </iconify-icon>
                                                </span>
                                                <div class="text-box">Pages</div>
                                            </div>
                                            <div
                                                class="flex-none text-sm ltr:ml-3 rtl:mr-3 leading-[1] relative top-1">
                                                <iconify-icon icon="heroicons-outline:chevron-down"> </iconify-icon>
                                            </div>
                                        </a>

                                        <!-- Dropdown menu -->


                                        <!-- Megamenu -->



                                        <div class="rt-mega-menu">
                                            <div class="flex flex-wrap space-x-8 justify-between rtl:space-x-reverse">



                                                <div>
                                                    <!-- mega menu title -->
                                                    <div
                                                        class="text-sm font-medium text-slate-900 dark:text-white mb-2 flex space-x-1 items-center">

                                                        <span> Authentication</span>
                                                    </div>
                                                    <!-- single menu item* -->



                                                    <a href=signin-one.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Signin One
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=signin-two.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Signin Two
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=signin-three.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Signin Three
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=signup-one.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Signup One
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=signup-two.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Signup Two
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=signup-three.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Signup Three
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=forget-password-one.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Forget Password One
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=forget-password-two.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Forget Password Two
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=forget-password-three.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Forget Password Three
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=lock-screen-one.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Lock Screen One
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=lock-screen-two.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Lock Screen Two
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=lock-screen-three.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Lock Screen Three
                                                            </span>
                                                        </div>

                                                    </a>

                                                </div>



                                                <div>
                                                    <!-- mega menu title -->
                                                    <div
                                                        class="text-sm font-medium text-slate-900 dark:text-white mb-2 flex space-x-1 items-center">

                                                        <span> Components</span>
                                                    </div>
                                                    <!-- single menu item* -->



                                                    <a href=typography.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                typography
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=colors.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                colors
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=alert.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                alert
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=button.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                button
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=card.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                card
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=carousel.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                carousel
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=dropdown.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                dropdown
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=image.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                image
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=modal.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                modal
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=progress-bar.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Progress bar
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=placeholder.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Placeholder
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=tab-accordion.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Tab &amp; Accordion
                                                            </span>
                                                        </div>

                                                    </a>

                                                </div>



                                                <div>
                                                    <!-- mega menu title -->
                                                    <div
                                                        class="text-sm font-medium text-slate-900 dark:text-white mb-2 flex space-x-1 items-center">

                                                        <span> Forms</span>
                                                    </div>
                                                    <!-- single menu item* -->



                                                    <a href=input.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Input
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=input-group.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Input group
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=input-layout.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Input layout
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=form-validation.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Form validation
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=form-wizard.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Wizard
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=input-mask.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Input mask
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=file-input>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                File input
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=form-repeater.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Form repeater
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=textarea.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Textarea
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=checkbox.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Checkbox
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=radio-button.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Radio button
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=switch.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Switch
                                                            </span>
                                                        </div>

                                                    </a>

                                                </div>



                                                <div>
                                                    <!-- mega menu title -->
                                                    <div
                                                        class="text-sm font-medium text-slate-900 dark:text-white mb-2 flex space-x-1 items-center">

                                                        <span> Utility</span>
                                                    </div>
                                                    <!-- single menu item* -->



                                                    <a href=invoice.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Invoice
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=pricing.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Pricing
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=faq.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                FAQ
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=blank-page.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Blank page
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=blog.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Blog
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=404.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                404 page
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=comming-soon.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Coming Soon
                                                            </span>
                                                        </div>

                                                    </a>



                                                    <a href=under-maintanance.html>

                                                        <div
                                                            class="flex items-center space-x-2 text-[15px] leading-6 rtl:space-x-reverse">
                                                            <span
                                                                class="h-[6px] w-[6px] rounded-full border border-slate-600 dark:border-white inline-block flex-none"></span>
                                                            <span
                                                                class="capitalize text-slate-600 dark:text-slate-300">
                                                                Under Maintanance page
                                                            </span>
                                                        </div>

                                                    </a>

                                                </div>

                                            </div>
                                        </div>

                                    </li>

                                    <li class=" menu-item-has-children  ">
                                        <!--  Single menu -->

                                        <!-- has dropdown -->



                                        <a href="javascript:void()">
                                            <div class="flex flex-1 items-center space-x-[6px] rtl:space-x-reverse">
                                                <span class="icon-box">
                                                    <iconify-icon icon=heroicons-outline:view-grid-add> </iconify-icon>
                                                </span>
                                                <div class="text-box">Widgets</div>
                                            </div>
                                            <div
                                                class="flex-none text-sm ltr:ml-3 rtl:mr-3 leading-[1] relative top-1">
                                                <iconify-icon icon="heroicons-outline:chevron-down"> </iconify-icon>
                                            </div>
                                        </a>

                                        <!-- Dropdown menu -->



                                        <ul class="sub-menu">



                                            <li>
                                                <a href=basic-widgets.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:document-text
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Basic
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=statistics-widgets.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:document-text
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Statistic
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>

                                        </ul>

                                        <!-- Megamenu -->


                                    </li>

                                    <li class="  menu-item-has-children   ">
                                        <!--  Single menu -->

                                        <!-- has dropdown -->



                                        <a href="javascript:void()">
                                            <div class="flex flex-1 items-center space-x-[6px] rtl:space-x-reverse">
                                                <span class="icon-box">
                                                    <iconify-icon icon=heroicons-outline:template> </iconify-icon>
                                                </span>
                                                <div class="text-box">Extra</div>
                                            </div>
                                            <div
                                                class="flex-none text-sm ltr:ml-3 rtl:mr-3 leading-[1] relative top-1">
                                                <iconify-icon icon="heroicons-outline:chevron-down"> </iconify-icon>
                                            </div>
                                        </a>

                                        <!-- Dropdown menu -->



                                        <ul class="sub-menu">



                                            <li>
                                                <a href=basic-table.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:table
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Basic Table
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=advance-table.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:table
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Advanced table
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=apex-chart.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:chart-bar
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Apex chart
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=chartjs.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:chart-bar
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Chart js
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>



                                            <li>
                                                <a href=map.html>
                                                    <div class="flex space-x-2 items-start rtl:space-x-reverse">
                                                        <iconify-icon icon=heroicons-outline:map
                                                            class="leading-[1] text-base"> </iconify-icon>
                                                        <span class="leading-[1]">
                                                            Map
                                                        </span>
                                                    </div>
                                                </a>
                                            </li>

                                        </ul>

                                        <!-- Megamenu -->


                                    </li>

                                </ul>
                            </div>
                            <!-- end top menu -->
                          

                            @include('layouts.header')
                            <!-- end nav tools -->
                        </div>
                    </div>
                </div>

                <!-- BEGIN: Search Modal -->
                <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
                    id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                    <div class="modal-dialog relative w-auto pointer-events-none top-1/4">
                        <div
                            class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-900 bg-clip-padding rounded-md outline-none text-current">
                            <form>
                                <div class="relative">
                                    <input type="text" class="form-control !py-3 !pr-12" placeholder="Search">
                                    <button
                                        class="absolute right-0 top-1/2 -translate-y-1/2 w-9 h-full border-l text-xl border-l-slate-200 dark:border-l-slate-600 dark:text-slate-300 flex items-center justify-center">
                                        <iconify-icon icon="heroicons-solid:search"></iconify-icon>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END: Search Modal -->
                <!-- END: Header -->
                <!-- END: Header -->
                <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]"  id="content_wrapper">
                    <div class="page-content">
                        @yield('body')
                    </div>
                </div>
            </div>

            <!-- BEGIN: Footer For Desktop and tab -->
            <footer class="md:block hidden" id="footer">
                <div
                    class="site-footer px-6 bg-white dark:bg-slate-800 text-slate-500 dark:text-slate-300 py-4 ltr:ml-[248px] rtl:mr-[248px]">
                    <div class="grid md:grid-cols-2 grid-cols-1 md:gap-5">
                        <div class="text-center ltr:md:text-start rtl:md:text-right text-sm">
                            COPYRIGHT ©
                            <span id="thisYear"></span>
                            DashCode, All rights Reserved
                        </div>
                        <div class="ltr:md:text-right rtl:md:text-end text-center text-sm">
                            Hand-crafted &amp; Made by
                            <a href="https://codeshaper.net" target="_blank"
                                class="text-primary-500 font-semibold">
                                Codeshaper
                            </a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- END: Footer For Desktop and tab -->

            <div class="bg-white bg-no-repeat custom-dropshadow footer-bg dark:bg-slate-700 flex justify-around items-center backdrop-filter backdrop-blur-[40px] fixed left-0 bottom-0 w-full z-[9999] bothrefm-0 py-[12px] px-4 md:hidden">
                <a href="chat.html">
                    <div>
                        <span class="relative cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center mb-1 dark:text-white text-slate-900 ">
                            <iconify-icon icon="heroicons-outline:mail"></iconify-icon>
                            <span
                                class="absolute right-[5px] lg:hrefp-0 -hrefp-2 h-4 w-4 bg-red-500 text-[8px] font-semibold flex flex-col items-center justify-center rounded-full text-white z-[99]">
                                10
                            </span>
                        </span>
                        <span class="block text-[11px] text-slate-600 dark:text-slate-300">
                            Messages
                        </span>
                    </div>
                </a>
                <a href="profile.html" class="relative bg-white bg-no-repeat backdrop-filter backdrop-blur-[40px] rounded-full footer-bg dark:bg-slate-700 h-[65px] w-[65px] z-[-1] -mt-[40px] flex justify-center items-center">
                    <div class="h-[50px] w-[50px] rounded-full relative left-[0px] hrefp-[0px] custom-dropshadow">
                        <img src="{{ asset('assets/temp2/assets/images/users/user-1.jpg')}}" alt="" class="w-full h-full rounded-full border-2 border-slate-100">
                    </div>
                </a>
                <a href="#">
                    <div>
                        <span
                            class=" relative cursor-pointer rounded-full text-[20px] flex flex-col items-center justify-center mb-1 dark:text-white
          text-slate-900">
                            <iconify-icon icon="heroicons-outline:bell"></iconify-icon>
                            <span
                                class="absolute right-[17px] lg:hrefp-0 -hrefp-2 h-4 w-4 bg-red-500 text-[8px] font-semibold flex flex-col items-center
            justify-center rounded-full text-white z-[99]">
                                2
                            </span>
                        </span>
                        <span class=" block text-[11px] text-slate-600 dark:text-slate-300">
                            Notifications
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </main>
    <!-- scripts -->
    @yield('script')
    <script src="{{ asset('assets/temp2/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/temp2/assets/js/rt-plugins.js') }}"></script>
    <script src="{{ asset('assets/temp2/assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/alertas/sweetalert2.all.min.js') }}"></script>
   
</body>

</html>
