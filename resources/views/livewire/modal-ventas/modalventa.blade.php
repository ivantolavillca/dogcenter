<div wire:ignore.self id="modalventa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-10 border-start border-5 border-primary">
            <!-- Contenido del modal -->
            <div class="modal-body">
                <div class="text-center">
                    <h4>Detalle de Ventas</h4>
                    <div>
                        <h1>
                            {{ $Idventa }}
                        </h1>
                        @if($Idventa)
                        <a href="{{ route('imprimirVentas', ['idm' => $Idventa, 'es' => 2]) }}" class="btn btn-primary ficha-clinica rounded-pill" target="_blank">
                                <i class="fas fa-print"></i> Imprimir
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
                            <td>{{ $item->id_venta }}</td>
                            <td>{{ $item->produc_ventas->nombre }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>{{ $item->cantidad }}</td>
                            <td>{{ $item->precio }}</td>
                            <td>{{ $item->cantidad*$item->precio }}</td>
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