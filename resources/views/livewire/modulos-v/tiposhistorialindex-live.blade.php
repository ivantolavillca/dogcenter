<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACIÓ DE ESTUDIOS COMPLEMENTARIOS</h4>
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

        <button class="btn btn-info col-md-12" data-bs-toggle="modal" data-bs-target="#">
            <i class="bx bxs-plus-circle"></i> AGREGAR ESTUDIOS COMPLEMENTARIOS
        </button>

        <div class="col-12 mt-3">
            <label for="gestiones" class="form-label">Buscar Estudios complementarios: </label>
            <input type="text" class="form-control" wire:model="searchEstudio">
        </div>
        <br>
    </div>
        
     

</div>
@push('molqui-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodalEstudioComple', function() {
            $('#modalestudiocomplementario').modal('hide');
        });
        Livewire.on('abrirmodalEstudio', function() {
            $('#modalestudiocomplementario').modal('show');
        });
    });

    livewire.on('borrarEstudicomple', id_estudio => {
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
                livewire.emit('Eliminarestudiocomple', id_estudio);
                Swal.fire(
                    'Eliminado!',
                    'La especie ha sido eliminado..',
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