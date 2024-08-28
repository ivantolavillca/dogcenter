<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACIÓ DE MASCOTAS</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Mascotas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto">
        <div class="mb-3 row">
            <!-- Columna para Agregar Especie y su búsqueda -->
            <div class="col-6">
                <hr>
                <a href="{{ route('mascotasraza') }}" class="btn btn-info col-md-12">
                    <i class="bx bxs-plus-circle"></i> RAZAS
                </a>
                <hr>
                <a href="{{ route('mascotasespecie')}}" class="btn btn-info col-md-12">
                    <i class="bx bxs-plus-circle"></i> ESPECIES
                </a>

                <hr>
                <a href="{{ route('mascotascolor')}}" class="btn btn-info col-md-12">
                    <i class="bx bxs-plus-circle"></i> COLORES
                </a>
            </div>
        </div>


    </div>