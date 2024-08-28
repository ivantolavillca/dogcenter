<div>
    <div class="row">
        <div class="card">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18 text-info">HISTORIALES ANTIGUOS PARA CLIENTES</h4>
                    </div>
                </div>
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item text-info"><a class="text-info" href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active text-info">HISTORIAL</li>
                    </ol>
                </div>
            </div>
            <div class="mb-3 row">
                <!-- Columna para Agregar Especie y su búsqueda -->

                <div class="col-md-6">

                    <hr>
                    <div class="col-12 mt-3">
                        <label for="gestiones" class="form-label">Buscar Cliente: </label>
                        <input type="text" class="form-control" wire:model="search">
                    </div>
                </div>
            </div>

            @if ($Personales->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOMBRE DEL CLIENTE</th>
                            <th scope="col">HISTORIAL DE MASCOTAS</th>
                            <th scope="col">HISTORIAL DETALLADA</th>
                            <th scope="col">HISTORIAL GENERAL</th>
                         

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Personales as $per)
                        <tr>
                            <td>{{ $per->id }}</td>
                            <td>{{ $per->nombre }} {{ $per->apellidos }}</td>
                            <td>
                                @if ($per)
                                    @foreach ($per->cliente_mascotas as $mascota)
                                        <div style="margin-bottom: 5px;">
                                            <span style="color: green; margin-right: 10px;">
                                                {{ $mascota->nombre }}
                                            </span>
                                            <button type="button" class="btn btn-primary btn-sm" wire:click="crearhistorial({{ $mascota->id }})">
                                                Cargar
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if ($per)
                                    @foreach ($per->cliente_mascotas as $mascota)
                                        <div style="margin-bottom: 5px;">
                                            <span style="color: green; margin-right: 10px;">
                                                {{ $mascota->nombre }}
                                            </span>
                                            <button type="button" class="btn btn-warning btn-sm" wire:click="openModalReporte({{ $mascota->id }})">
                                               Ver Historial
                                            </button>
                                        </div>
                                    @endforeach
                                @endif
                            </td>

                            <td>
                                @if ($per)
                                    @foreach ($per->cliente_mascotas as $mascota)
                                        <div style="margin-bottom: 5px;">
                                            <span style="color: green; margin-right: 10px;">
                                                {{ $mascota->nombre }}
                                            </span>
                                            <a href="{{ route('imprimirHistorialesp', ['f1' => $mascota->id]) }}" class="btn btn-success btn-sm" target="_blank">
                                                <i class="fas fa-print">GENERAR REPORTE </i> 
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </td>
                          
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $Personales->links() }}
            </div>
            @else
            <div class="px-5 py-3 border-gray-200 text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif


        </div>
    </div>
    @include('livewire.modal-historial.modalhistopas')
    @include('livewire.modal-historial.modareporte')
</div>

@push('navi-js')
    <script src="{{ asset('JSNAVI/historialespasados.js') }}"></script>
@endpush
