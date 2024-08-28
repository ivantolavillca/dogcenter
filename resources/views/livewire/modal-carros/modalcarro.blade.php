<!-- MODAL CARRO PARA VENTAS -->
<div wire:ignore.self id="modalcarroBD" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-10 border-start border-5 border-primary">
            <div class="modal-header">
                <div class="row">
                    <div class="text-center text-info h5">PRODUCTOS EN CARRO</div>
                </div>

            </div>
            <div class="modal-body">

                @if($estadocompraventa == 'compra')
                <div class="col-md-6">
                    <div class="modal-header">
                        <label class="form-label">NOMBRE DEL PROVEDOR <span class="text-danger">*</span></label>
                    </div>
                    <div class="m-0">
                        <div class="input-group">
                            <input type="text" wire:model="SearchCliente" class="form-control " placeholder="BUSCAR POR CI, NOMBRE, AP. " style="color: green;" aria-label="Recipient's username " @if($bloque) disabled @endif>
                            <button type="button" class="btn btn-danger" wire:click="limpiarmodalbusqueda"><i class="bx bx-x"></i></button>
                        </div>
                        @error('SearchCliente')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        @if($SearchCliente && $bloque==false)
                        @foreach ($proveedores as $prov)
                        <div class="input-group">
                            <label class="form-control">{{ "Nom: ".$prov->nombre . " Ci: " . $prov->ci }}</label>
                            <div class="input-group-append">
                                <button class="btn btn-success" wire:click="CargarDatosNombreCi({{$prov->id}})"><i class="bx bx-plus"></i></button>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="text-center text-muted">Realiza una búsqueda para ver los resultados.</div>
                        @endif
                    </div>
                </div>
                @else
                <div class="col-md-6">
                    <div class="modal-header">
                        <label class="form-label">NOMBRE DEL CLIENTE <span class="text-danger">*</span></label>
                    </div>
                    <div class="m-0">
                        <div class="input-group">
                            <input type="text" wire:model="SearchCliente" class="form-control " placeholder="BUSCAR POR CI, NOMBRE, AP. " style="color: green;" aria-label="Recipient's username " @if($bloque) disabled @endif>

                            <button type="button" class="btn btn-danger" wire:click="limpiarmodalbusqueda"><i class="bx bx-x"></i></button>

                        </div>
                        @error('SearchCliente')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                        @if($SearchCliente && $bloque==false)
                        @foreach ($clientes as $cli)
                        <div class="input-group">
                            <label class="form-control">{{ "Nom: ".$cli->nombre . " Ci: " . $cli->ci }}</label>
                            <div class="input-group-append">
                                <button class="btn btn-success" wire:click="CargarDatosNombreCi({{$cli->id}})"><i class="bx bx-plus"></i></button>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="text-center text-muted">Realiza una búsqueda para ver los resultados.</div>
                        @endif
                    </div>
                </div>
                @endif




                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio por defecto</th>
                            <th>Precio de compra </th>
                            <th>Unidad de medida</th>
                            <th>Stock</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($objv === null)
                        <tr>
                            <td colspan="3">No hay datos disponibles.</td>
                        </tr>
                        @elseif(is_array($objv) && count($objv) === 0)
                        <tr>
                            <td colspan="3">No hay datos disponibles.</td>
                        </tr>
                        @else
                        @foreach($objv as $index => $item)

                        <tr>

                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['nombre'] }}</td>
                            <td>
                                {{ $item['precio'] }}
                            </td>
                            <td>
                                @if($item['estado'] == 0)
                                <input type="text" class="form-control" wire:model="lista.{{ $index }}.preciom" placeholder="100">
                                @error('lista.'.$index.'.preciom')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @else
                                <span class="text-success font-weight-bold">{{ $item['preciom'] }}</span>
                                @endif

                            </td>
                            <td>
                                {{ $item['tuni'] }}
                            </td>
                            <td>
                                {{ $item['stock'] }}
                            </td>
                            <td>

                                @if($item['estado'] == 0)
                                <input type="text" class="form-control" wire:model="lista.{{ $index }}.cantidad" placeholder="10">
                                @error('lista.'.$index.'.cantidad')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @else
                                <span class="text-success font-weight-bold">{{ $item['cantidad'] }}</span>
                                @endif
                            </td>
                            <td>
                                @if(!is_numeric($item['preciom']))
                                <div class="text-danger">El precio deben ser números.</div>
                                @elseif(!is_numeric($item['cantidad']))

                                <div class="text-danger">La cantidad deben ser números.</div>
                                @else
                                {{ $item['cantidad'] * $item['preciom'] }}
                                @endif

                            </td>
                            <td>
                                <button class="btn btn-sm btn-success" wire:click="validarcarroventa({{ $index }})">
                                    <i class="fas fa-check"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" wire:click="eliminarcarro({{ $index }})">
                                    <i class="bx bxs-trash"></i>
                                </button>
                                <button class="btn btn-sm btn-warning" wire:click="editarcarroventa({{ $index }})">
                                    <i class="bx bxs-pencil"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="cancelarventa">ELIMINAR CARRO</button>

                @if($estadocompraventa=='compra')
                <button wire:click="comprarcarro" type="button" class="btn btn-success waves-effect waves-light">COMPRAR PRODUCTOS</button>
                @else
                <button wire:click="vendercarro" type="button" class="btn btn-success waves-effect waves-light">VENDER PRODUCTOS</button>
                @endif
                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-dismiss="modal">CERRAR</button>

            </div>
        </div>
    </div>
</div>