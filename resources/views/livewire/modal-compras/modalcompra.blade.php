<div wire:ignore.self id="modalcompra" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-10 border-start border-5 border-primary">
            <!-- Contenido del modal -->
            <div class="modal-body">
                <div class="text-center">
                    <h4>Detalle de Compras</h4>
                    <div>
                        <h1>
                            {{ $Idventa }}
                        </h1>
                        @if($Idventa)
                        <a href="{{ route('imprimirVentas', ['idm' => $Idventa, 'es' => 1]) }}" class="btn btn-primary" target="_blank">
                            <i class="bx bxs-printer"></i>
                        </a>
                        @else
                        <span>No se puede imprimir</span>
                        @endif

                        <button class="btn btn-danger mr-2" wire:click="LimpiarmodalTabla">
                            <i class="bx bx-exit"></i> SALIR
                        </button>
                    </div>
                </div>


                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ID de Venta</th>
                            <th>Nombre del Producto</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Sub Total</th>
                            <!-- Añade más encabezados de columnas según tu necesidad -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se cargarán las filas de la tabla -->
                        @if($this->data)
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->id_compra }}</td>
                            <td>{{ $item->produc_compras->nombre }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->cantidad_inicial }}</td>
                            <td>{{ $item->precio }}</td>
                            <td>{{ $item->cantidad_inicial*$item->precio }}</td>
                            <!-- Añade más columnas según tu necesidad -->
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tr>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                        <th>Total</th>
                        <th>{{ $totalDinero}}</th>
                        <!-- Añade más encabezados de columnas según tu necesidad -->
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>