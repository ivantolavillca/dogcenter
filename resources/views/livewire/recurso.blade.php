<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">PRUEBA </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Tesoreria</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <!-- OTRA SECCION -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-outline-primary waves-effect waves-light col-md-6" wire:click="abrir"> <i
                                    class="bx bxs-plus-circle">AGREGAR</i></button>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control col-md-6"
                                placeholder="Buscar...">
                        </div>
                    </div>

                    @if(count($sedes)>0)
                        <ul>
                            @foreach($sedes as $sede)
                                <li>{{json_encode($sede)}}</li>
                            @endforeach

                        </ul>
                    @endif
                    <div class="d-flex justify-content-center">
                        {{ $sedes->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- inicio modal 01 -->
    <div wire:ignore.self data-bs-backdrop="static" id="modalParaAbrir" class="modal fade" tabindex="-1"
        role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="dsfds"> AGRERGAR

                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        wire:click="cancelar"></button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="mb-6">
                            <label class="form-label">direccion:</label>
                            <input type="text" class="form-control" wire:model="direccion">
                            @error('direccion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                        wire:click="cancelar">CANCELAR</button>
                    <button class="btn btn-primary waves-effect waves-light"
                        wire:click="guardar_direccion">GUARDAR DATOS</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
    <!--    fin modal 01 -->

    <!-- scripts -->
    @push('navi-js')
        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('abrirFormulario', function() {
                    $('#modalParaAbrir').modal('show'); /* hide */
                });
            });
        </script>
    @endpush
</div>
