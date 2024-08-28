<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACIÓ DE TIPOS DE HSITORIAL</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">ESTUDIOS COMPLEMENTARIOS</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3 row">
        <!-- Columna para Agregar Especie y su búsqueda -->

        <button class="btn btn-info col-md-12" data-bs-toggle="modal" data-bs-target="#modaltiposhistoriales" >
            <i class="bx bxs-plus-circle"></i> AGREGAR TIPOS DE HISTORIALES
        </button>

        <div class="col-12 mt-3">
            <label for="gestiones" class="form-label">Buscar tipos de historiales: </label>
            <input type="text" class="form-control" wire:model="search">
        </div>
        <br>
    </div>
    <hr>
    @if ($tipohistoriales->count() > 0)
            <div class="table-responsive">
                <hr>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre del Tipo de Historial</th>
                            <th scope="col">Estado del registro</th>
                            <th scope="col">Acción</th>
                            <th scope="col">Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipohistoriales as $thisto)
                        <tr>
                            <td>{{ $thisto->id }}</td>
                            <td>{{ $thisto->nombre }}</td>
                            <td>
                            <p>Activo</p>
                            </td>
                            <td>
                               @if($thisto->estado=='activo')  
                      
                                <button class="btn btn-warning" wire:click="Editartipohist({{$thisto->id}})">
                                    <i class="bx bx-pencil"></i>
                                </button>
                               
                                @endif
                            </td>
                          
                            <td>{{ $thisto->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="px-5 py-3 border-gray-200 text-sm">
                <strong>No hay Registros</strong>
            </div>
            @endif
        <div class="d-flex justify-content-center">
        {{ $tipohistoriales->links() }}
        </div>


    @include('livewire.modal-tiposhistorias.modaltiposhistorial')
</div>


@push('molqui-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodaltiphisto', function() {
            $('#modaltiposhistoriales').modal('hide');
        });
        Livewire.on('abrirmodalhisto', function() {
            $('#modaltiposhistoriales').modal('show');
        });
    });

    livewire.on('borrartiphistoriales', id_th => {
        Swal.fire({
            title: 'Esta seguro/segura ?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, bórralo!'
        }).then((result) => {
            if (result.isConfirmed) {
                livewire.emit('Eliminartipohistorial', id_th);
                Swal.fire(
                    'Eliminado!',
                    'El tipo de historial ha sido eliminado..',
                    'Exitosamente'
                )
            } else {
                Swal.fire({
                    title: 'Su registro de especie esta seguro...',
                    icon: 'info',
                })
            }
        })
    });
</script>
@endpush