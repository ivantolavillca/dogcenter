<div class="sidebar-menus bg-white dark:bg-slate-800 py-2 px-4 h-[calc(100%-80px)] overflow-y-auto z-50"
id="sidebar_menus">
<ul class="sidebar-menu">
    <li class="sidebar-menu-title">MENU</li>
    <li class="">
        <a href="{{ route('admin.home.index') }}" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:home"></iconify-icon>
                <span>INICIO</span>
            </span>
        </a>
    </li>
    <li class="">
        <a href="javascript:void(0)" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:lock-closed"></iconify-icon>
                <span>ADMINISTRACION USUARIOS</span>
            </span>
            <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('usuarios.index') }}">USUARIOS</a>
            </li>
            <li>
                <a href="signin-two.html">ROLES</a>
            </li>
            <li>
                <a href="signin-three.html">PERMISOS</a>
            </li>
            {{-- <li>
                <a href="signup-one.html">Signup One</a>
            </li>
            <li>
                <a href="signup-two.html">Signup Two</a>
            </li>
            <li>
                <a href="signup-three.html">Signup Three</a>
            </li>
            <li>
                <a href="forget-password-one.html">Forget Password One</a>
            </li>
            <li>
                <a href="forget-password-two.html">Forget Password Two</a>
            </li>
            <li>
                <a href="forget-password-three.html">Forget Password Three</a>
            </li>
            <li>
                <a href="lock-screen-one.html">Lock Screen One</a>
            </li>
            <li>
                <a href="lock-screen-two.html">Lock Screen Two</a>
            </li>
            <li>
                <a href="lock-screen-three.html">Lock Screen Three</a>
            </li> --}}
        </ul>
    </li>
    <li class="">
        <a href="javascript:void(0)" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:clipboard-list">
                </iconify-icon>
                <span>ADMINISTRACION CERTIFICADOS</span>
            </span>
            <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('tipo_certificado.index') }}">TIPO CERTIFICAO</a>
            </li>
            <li>
                <a href="{{ route('modelo_certificado.index') }}">MODELO CERTIFICADO</a>
            </li>
            {{-- <li>
                <a href="input-layout.html">Input layout</a>
            </li>
            <li>
                <a href="form-validation.html">Form validation</a>
            </li>
            <li>
                <a href="wizard.html">Wizard</a>
            </li>
            <li>
                <a href="input-mask.html">Input mask</a>
            </li>
            <li>
                <a href="file-input.html">File input</a>
            </li>
            <li>
                <a href="form-repeater.html">Form repeater</a>
            </li>
            <li>
                <a href="textarea.html">Textarea</a>
            </li>
            <li>
                <a href="checkbox.html">Checkbox</a>
            </li>
            <li>
                <a href="radio.html">Radio button</a>
            </li>
            <li>
                <a href="switch.html">Switch</a>
            </li>
            <li>
                <a href="select.html">Select</a>
            </li>
            <li>
                <a href="date-picker.html">Date time picker</a>
            </li> --}}
        </ul>
    </li>
    <li class="">
        <a href="javascript:void(0)" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:clipboard-list">
                </iconify-icon>
                <span>PLANIFICAR KARDEX</span>
            </span>
            <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="{{ route('planificar_certificado.index') }}">PLANIFICAR <br>CONVOCATORIA</a>
            </li>
            <li>
                <a href="">PLANIFICAR <br> ASIGNATURA</a>
            </li>
          
            {{-- 
            <li>
                <a href="form-validation.html">Form validation</a>
            </li>
            <li>
                <a href="wizard.html">Wizard</a>
            </li>
            <li>
                <a href="input-mask.html">Input mask</a>
            </li>
            <li>
                <a href="file-input.html">File input</a>
            </li>
            <li>
                <a href="form-repeater.html">Form repeater</a>
            </li>
            <li>
                <a href="textarea.html">Textarea</a>
            </li>
            <li>
                <a href="checkbox.html">Checkbox</a>
            </li>
            <li>
                <a href="radio.html">Radio button</a>
            </li>
            <li>
                <a href="switch.html">Switch</a>
            </li>
            <li>
                <a href="select.html">Select</a>
            </li>
            <li>
                <a href="date-picker.html">Date time picker</a>
            </li> --}}
        </ul>
    </li>
    {{-- <li class="">
        <a href="#" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:home"></iconify-icon>
                <span>Dashboard</span>
            </span>
            <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="index.html">Analytics Dashboard</a>
            </li>
            <li>
                <a href="ecommerce-dashboard.html">Ecommerce Dashboard
                </a>
            </li>
            <li>
                <a href="project-dashboard.html">Project Dashboard
                </a>
            </li>
            <li>
                <a href="crm-dashboard.html">CRM Dashboard
                </a>
            </li>
            <li>
                <a href="banking-dashboard.html">Banking Dashboard
                </a>
            </li>
        </ul>
    </li>

    <li class="sidebar-menu-title">APPS</li>
    <li>
        <a href="chat.html" class="navItem">
            <span class="flex items-center">
                <iconify-icon class="nav-icon" icon="heroicons-outline:chat"></iconify-icon>
                <span>Chat</span>
            </span>
        </a>
    </li>
    <li class="">
        <a href="email.html" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:mail"></iconify-icon>
                <span>Email</span>
            </span>
        </a>
    </li>
    
    <li class="">
        <a href="calander.html" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:calendar"></iconify-icon>
                <span>Calander</span>
            </span>
        </a>
    </li>
    <li class="">
        <a href="todo.html" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:clipboard-check"></iconify-icon>
                <span>Todo</span>
            </span>
        </a>
    </li>
    <li class="">
        <a href="javascript:void(0)" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:document"></iconify-icon>
                <span>Projects</span>
            </span>
            <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="project.html">Projects</a>
            </li>
            <li>
                <a href="project-details.html">Project Details</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-menu-title">PAGES</li>
  
    <li class="">
        <a href="javascript:void(0)" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:lock-closed"></iconify-icon>
                <span>Authentication</span>
            </span>
            <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="signin-one.html">Signin One</a>
            </li>
            <li>
                <a href="signin-two.html">Signin Two</a>
            </li>
            <li>
                <a href="signin-three.html">Signin Three</a>
            </li>
            <li>
                <a href="signup-one.html">Signup One</a>
            </li>
            <li>
                <a href="signup-two.html">Signup Two</a>
            </li>
            <li>
                <a href="signup-three.html">Signup Three</a>
            </li>
            <li>
                <a href="forget-password-one.html">Forget Password One</a>
            </li>
            <li>
                <a href="forget-password-two.html">Forget Password Two</a>
            </li>
            <li>
                <a href="forget-password-three.html">Forget Password Three</a>
            </li>
            <li>
                <a href="lock-screen-one.html">Lock Screen One</a>
            </li>
            <li>
                <a href="lock-screen-two.html">Lock Screen Two</a>
            </li>
            <li>
                <a href="lock-screen-three.html">Lock Screen Three</a>
            </li>
        </ul>
    </li>

    <li class="">
        <a href="javascript:void(0)" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:view-boards"></iconify-icon>
                <span>Utility</span>
            </span>
            <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="invoice.html">Invoice</a>
            </li>
            <li>
                <a href="pricing.html">Pricing</a>
            </li>
            <li>
                <a href="blog.html">Blog</a>
            </li>
            <li>
                <a href="blank-page.html">Blank Page</a>
            </li>
            <li>
                <a href="settings.html">Settings</a>
            </li>
            <li>
                <a href="profile.html">Profile</a>
            </li>
            <li>
                <a href="404.html">404 Page</a>
            </li>
            <li>
                <a href="comming-soon.html">Coming Soon</a>
            </li>
            <li>
                <a href="under-maintanance.html">Under Maintanance</a>
            </li>
        </ul>
    </li>
 
    <li class="sidebar-menu-title">ELEMENTS</li>
  
    <li class="">
        <a href="javascript:void(0)" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:view-grid-add"></iconify-icon>
                <span>Widgets</span>
            </span>
            <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="basic-widgets.html">Basic</a>
            </li>
            <li>
                <a href="statistics-widgets.html">Statistic</a>
            </li>
        </ul>
    </li>
   
    <li>
        <a href="javascript:void(0)" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:collection"></iconify-icon>
                <span>Components</span>
            </span>
            <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="typography.html">Typography</a>
            </li>
            <li>
                <a href="colors.html">Colors</a>
            </li>
            <li>
                <a href="alert.html">Alert</a>
            </li>
            <li>
                <a href="buttons.html">Button</a>
            </li>
            <li>
                <a href="card.html">Card</a>
            </li>
            <li>
                <a href="carousel.html">Carousel</a>
            </li>
            <li>
                <a href="dropdown.html">Dropdown</a>
            </li>
            <li>
                <a href="image.html">Image</a>
            </li>
            <li>
                <a href="modal.html">Modal</a>
            </li>
            <li>
                <a href="progressbar.html">Progress bar</a>
            </li>
            <li>
                <a href="placeholder.html">Placeholder</a>
            </li>
            <li>
                <a href="tab-accordion.html">Tab & Accordion</a>
            </li>
            <li>
                <a href="badges.html">Badges</a>
            </li>
            <li>
                <a href="pagination.html">Pagination</a>
            </li>
            <li>
                <a href="video.html">Video</a>
            </li>
            <li>
                <a href="tooltip-popover.html">Tooltip & Popover</a>
            </li>
        </ul>
    </li>
    
    <li class="">
        <a href="javascript:void(0)" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:clipboard-list">
                </iconify-icon>
                <span>Forms</span>
            </span>
            <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="input.html">Input</a>
            </li>
            <li>
                <a href="input-group.html">Input group</a>
            </li>
            <li>
                <a href="input-layout.html">Input layout</a>
            </li>
            <li>
                <a href="form-validation.html">Form validation</a>
            </li>
            <li>
                <a href="wizard.html">Wizard</a>
            </li>
            <li>
                <a href="input-mask.html">Input mask</a>
            </li>
            <li>
                <a href="file-input.html">File input</a>
            </li>
            <li>
                <a href="form-repeater.html">Form repeater</a>
            </li>
            <li>
                <a href="textarea.html">Textarea</a>
            </li>
            <li>
                <a href="checkbox.html">Checkbox</a>
            </li>
            <li>
                <a href="radio.html">Radio button</a>
            </li>
            <li>
                <a href="switch.html">Switch</a>
            </li>
            <li>
                <a href="select.html">Select</a>
            </li>
            <li>
                <a href="date-picker.html">Date time picker</a>
            </li>
        </ul>
    </li>
    
    <li class="">
        <a href="javascript:void(0)" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:table"></iconify-icon>
                <span>Tables</span>
            </span>
            <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="basic-table.html">Basic table</a>
            </li>
            <li>
                <a href="advance-table.html">Advanced table</a>
            </li>
        </ul>
    </li>
    
    <li class="">
        <a href="javascript:void(0)" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:chart-bar"></iconify-icon>
                <span>Chart</span>
            </span>
            <iconify-icon class="icon-arrow" icon="heroicons-outline:chevron-right"></iconify-icon>
        </a>
        <ul class="sidebar-submenu">
            <li>
                <a href="apex-chart.html">Apex chart</a>
            </li>
            <li>
                <a href="chartjs.html">Chart js</a>
            </li>
        </ul>
    </li>
    
    <li class="">
        <a href="map.html" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:map"></iconify-icon>
                <span>Map</span>
            </span>
        </a>
    </li>
    
    <li class="">
        <a href="icons.html" class="navItem">
            <span class="flex items-center">
                <iconify-icon class=" nav-icon" icon="heroicons-outline:emoji-happy"></iconify-icon>
                <span>Icons</span>
            </span>
        </a>
    </li> --}}
</ul>

</div>