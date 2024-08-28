    <div wire:ignore.self id="modalfarmaciam" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-10 border-start border-5  border-primary">
                <div class="modal-header">
                    @if (true)
                        <div class="row">
                            <div class="text-center text-info h5"> REGISTRAR FARMACIAS</div>
                        </div>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" wire:model="Idprovedor">
                            <label class="form-label">NOMBRE DEL DUEÑO DE LA MASCOTA <span
                                    class="text-danger">*</span></label>
                            @if ($registro_completof)
                                <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                    {{ $registro_completof->mascot_clie->nombre }}
                                </p>
                            @endif
                            <hr>
                            <label class="form-label">NOMBRE DE LA MASCOTA <span class="text-danger">*</span></label>
                            @if ($registro_completof)
                                <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                    {{ $registro_completof->nombre }}
                                </p>
                            @endif
                            <hr>

                        </div>
                        <div class="col-md-6">
                            <div class="modal-header">
                                <label class="form-label">NOMBRE DEL PRODUCTO <span class="text-danger">*</span></label>
                            </div>
                            <div class="m-0">
                                <div class="input-group">
                                    <input type="text" wire:model="Searchproductof" class="form-control "
                                        placeholder="BUSCAR POR NOMBRE O DESCRIPCION " style="color: green;"
                                        aria-label="Recipient's username "
                                        @if ($bloque) disabled @endif>
                                    <button type="button" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                @error('Searchproductof')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <br>
                                @if ($Searchproductof)
                                    @foreach ($productosfar as $prov)
                                        <div class="input-group">
                                            <label class="form-control">{{ 'Nom: ' . $prov->nombre }}</label>
                                            <div class="input-group-append">
                                                <button class="btn btn-success"
                                                    wire:click="CargarDatosproductof({{ $prov->id }})"><i
                                                        class="bx bx-plus"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center text-muted">Realiza una búsqueda para ver los resultados.
                                    </div>
                                @endif
                            </div>
                        </div>


                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Precio por defecto</th>
                                    <th>Precio de venta </th>
                                    <th>Unidad de medida</th>
                                    <th>Stock</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lista === null)
                                    <tr>
                                        <td colspan="3">No hay datos disponibles.</td>
                                    </tr>
                                @elseif(is_array($lista) && count($lista) === 0)
                                    <tr>
                                        <td colspan="3">No hay datos disponibles.</td>
                                    </tr>
                                @else
                                    @foreach ($lista as $index => $item)
                                        <tr>

                                            <td>{{ $item['id'] }}</td>
                                            <td>{{ $item['nombre'] }}</td>
                                            <td>
                                                {{ $item['precio'] }}
                                            </td>
                                            <td>
                                                @if ($item['estado'] == 0)
                                                    <input type="text" class="form-control"
                                                        wire:model="lista.{{ $index }}.preciom"
                                                        placeholder="100">
                                                    @error('lista.' . $index . '.preciom')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                @else
                                                    <span
                                                        class="text-success font-weight-bold">{{ $item['preciom'] }}</span>
                                                @endif

                                            </td>
                                            <td>
                                                {{ $item['tuni'] }}
                                            </td>
                                            <td>
                                                {{ $item['stock'] }}
                                            </td>
                                            <td>

                                                @if ($item['estado'] == 0)
                                                    <input type="text" class="form-control"
                                                        wire:model="lista.{{ $index }}.cantidad"
                                                        placeholder="10">
                                                    @error('lista.' . $index . '.cantidad')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                @else
                                                    <span
                                                        class="text-success font-weight-bold">{{ $item['cantidad'] }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!is_numeric($item['preciom']))
                                                    <div class="text-danger">El precio deben ser números.</div>
                                                @elseif(!is_numeric($item['cantidad']))
                                                    <div class="text-danger">La cantidad deben ser números.</div>
                                                @else
                                                    {{ $item['cantidad'] * $item['preciom'] }}
                                                @endif

                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-success"
                                                    wire:click="validarcarroventa({{ $index }})">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger"
                                                    wire:click="eliminarcarro({{ $index }})">
                                                    <i class="bx bxs-trash"></i>
                                                </button>
                                                <button class="btn btn-sm btn-warning"
                                                    wire:click="editarcarroventa({{ $index }})">
                                                    <i class="bx bxs-pencil"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        {{ $totalprecio += $item['total'] }}
                                    @endforeach
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total -> </td>
                                    <td>
                                        {{ $totalprecio }}
                                    </td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                            wire:click="cerarFarmacias">SALIR</button>
                        <button type="button" class="btn btn-success waves-effect"
                            wire:click="vendercarro">VENDER</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
