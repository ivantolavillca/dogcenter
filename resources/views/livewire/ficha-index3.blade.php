<div>
    <div class="row">
        <div class="card">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">LISTA DE VENTAS DE PRODUCTOS</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Productos</li>
                            
                        </ol>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-12 mt-3">
                    <label for="gestiones" class="form-label">Buscar producto: </label>
                    <button class="btn btn-info col-md-12" wire:click="abrirModalCompra">
               REALIZAR VENTA
            </button>
                    <input type="text" class="form-control" wire:model="searchProducto">
                </div>
            </div>

            <hr>

           
        </div>
    </div>
</div>