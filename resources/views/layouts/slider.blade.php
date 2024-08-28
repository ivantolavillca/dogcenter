<div id="sidebar-menu">

    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>


        
        <li>

            <a href="{{ route('admin.home.index') }}" class="waves-effect">
                <i class="mdi mdi-airplay"></i>
                <span>INICIO</span>
            </a>
        </li>
        @if(Auth::user()->roles[0]->name == 'encargado' or Auth::user()->roles[0]->name == 'admin')
        <li>

            <a href="{{ route('ReportesDoctores') }}" class="waves-effect">
                <i class="mdi mdi-airplay"></i>
                <span>REPORTES</span>
            </a>
        </li>
        @endif
        <li>

            <a href="{{ route('recepcion') }}" class="waves-effect">
                <i class="mdi mdi-airplay"></i>
                <span>RECEPCIÓN</span>
            </a>
        </li>
        @canany(['users', 'roles'])
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-shield-account-outline"></i>
                <span>ADMINISTRACION USUARIOS</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @can('users')
                <li><a href="{{ route('usuarios.index') }}">USUARIOS</a></li>
                @endcan
                    @can('roles')
                <li><a href="{{ route('roles.index') }}">ROLES</a></li>
                @endcan
            </ul>
        </li>
        @endcanany
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-calendar-check"></i>
                <span>ADMINISTRACION DE PAGINA</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">

                <li><a href="{{ route('contenido-principal') }}">DATOS DE <br> LA CLINICA</a></li>


                <li><a href="{{ route('publicaciones') }}">PUBLICACIÓNES</a></li>




            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-rabbit"></i>
                <span>ADMINISTRACION DE MASCOTAS</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">

                <li><a href="{{ route('mascotasraza') }}">RAZAS</a></li>


                <li><a href="{{ route('mascotasespecie') }}">ESPECIES</a></li>
                <li><a href="{{ route('mascotascolor') }}">COLORES</a></li>




            </ul>
        </li>
        <li class="menu-title">CONTENIDO</li>

        <li>
            <a href="{{ route('fichas') }}" class="waves-effect">
                <i class="mdi mdi-file-settings-outline"></i>
                <span>FICHAS</span>
            </a>
        </li>
        <li>
        <li>
            <a href="{{ route('clientes') }}" class="waves-effect">
                <i class="mdi mdi-human-greeting"></i>
                <span>CLIENTES</span>
            </a>
        </li>
        <li>
            <a href="{{ route('proveedores') }}" class="waves-effect">
                <i class="mdi mdi-human-male-male"></i>
                <span>PROVEEDORES</span>
            </a>
        </li>
   
        <li>
            <a href="{{ route('tiposhistorias') }}" class="waves-effect">
                <i class="mdi mdi-file-settings-variant-outline"></i>
                <span>TIPOS DE HISTORIALES</span>
            </a>
        </li>
        <li>
            <a href="{{ route('enfermedades') }}" class="waves-effect">
                <i class="mdi mdi-skull"></i>
                <span>POSIBLES CASOS DE ENFERMEDADES</span>
            </a>
        </li>
        <li>
            <a href="{{ route('estudiocomplementarios') }}" class="waves-effect">
                <i class="mdi mdi-flask-remove-outline"></i>
                <span> ESTUDIOS COMPLEMENTARIOS</span>
            </a>
        </li>
        <li>
            <a href="{{ route('productos') }}" class="waves-effect">
                <i class="mdi mdi-star-box-outline"></i>
                <span>PRODUCTOS</span>
            </a>
        </li>
        <li>
            <a href="{{ route('entradas') }}" class="waves-effect">
                <i class="mdi mdi-shopify"></i>
                <span>COMPRAS</span>
            </a>
        </li>
        <li>
            <a href="{{ route('salidas') }}" class="waves-effect">
                <i class="mdi mdi-shopping"></i>
                <span>VENTAS</span>
            </a>
        </li>
        <li>
            <a href="{{ route('historialesp') }}" class="waves-effect">
                <i class="mdi mdi-shopping"></i>
                <span>HISTORIALES ANTIGUOS</span>
            </a>
        </li>
    </ul>
</div>
