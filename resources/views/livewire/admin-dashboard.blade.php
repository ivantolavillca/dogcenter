<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Escritorio</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">
                            Bienvenido!!!
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        @if (Auth::user()->roles[0]->name == 'admin')
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('clientes') }}" class="btn btn-success btn-lg w-100 py-5"> <i style="font-size: 5rem;"
                        class="fas fa-users "></i> <br>
                    <h4> Clientes</h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('usuarios.index') }}" class="btn btn-warning btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="fas fa-user-lock"></i> <br>
                    <h4>Usuarios</h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('contenido-principal') }}" class="btn btn-danger btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="mdi mdi-page-layout-sidebar-right"></i> <br>
                    <h4> Descripción de Pagina<br></h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('mascotasraza') }}" class="btn btn-info btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="mdi mdi-battlenet"></i> <br>
                    <h4> Razas de mascota</h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('mascotasespecie') }}" class="btn btn-secondary btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="fas fa-feather-alt"></i> <br>
                    <h4> Especies de mascota</h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('mascotascolor') }}" class="btn btn-primary btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="fas fa-layer-group"></i> <br>
                    <h4> Colores de mascota</h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('fichas') }}" class="btn btn-success btn-lg w-100 py-5"> <i style="font-size: 5rem;"
                        class="fas fa-list-alt"></i> <br>
                    <h4> Fichas</h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('proveedores') }}" class="btn btn-warning btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="fas fa-truck"></i> <br>
                    <h4>Proveedores</h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('tiposhistorias') }}" class="btn btn-danger btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="mdi mdi-file-document-box-search"></i> <br>
                    <h4> Tipos de Historial<br></h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('estudiocomplementarios') }}" class="btn btn-info btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="mdi mdi-flask-remove-outline"></i> <br>
                    <h4> Estudios Comp.</h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('enfermedades') }}" class="btn btn-secondary btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="mdi mdi-skull"></i> <br>
                    <h4> Casos de enfermedad</h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('productos') }}" class="btn btn-primary btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="mdi mdi-store"></i> <br>
                    <h4>Lista de Productos</h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('entradas') }}" class="btn btn-success btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="mdi mdi-clipboard-check"></i> <br>
                    <h4> Compras</h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('salidas') }}" class="btn btn-warning btn-lg w-100 py-5"> <i style="font-size: 5rem;"
                        class="mdi mdi-clipboard-plus"></i> <br>
                    <h4>Ventas</h4>
                </a>
            </div>

            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('publicaciones') }}" class="btn btn-info btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="mdi mdi-expand-all-outline"></i> <br>
                    <h4> Publicaciones</h4>
                </a>
            </div>
        @elseif(Auth::user()->roles[0]->name == 'Doctor')
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('recepcion') }}" class="btn btn-warning btn-lg w-100 py-5"> <i
                        style="font-size: 5rem;" class="mdi mdi-clipboard-plus"></i> <br>
                    <h4>Recepción</h4>
                </a>
            </div>

            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('clientes') }}" class="btn btn-info btn-lg w-100 py-5"> <i style="font-size: 5rem;"
                        class="mdi mdi-expand-all-outline"></i> <br>
                    <h4> Clientes</h4>
                </a>
            </div>
            <div class="col-6  d-flex justify-content-center align-items-center mt-5">
                <a href="{{ route('farmacia') }}" class="btn btn-success btn-lg w-100 py-5"> <i style="font-size: 5rem;"
                        class="mdi mdi-clipboard-plus"></i> <br>
                    <h4>Farmacia</h4>
                </a>
            </div>
        @endif

    </div>


</div>
