    <div wire:ignore.self id="modalfarmaciam" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-xl">
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
                                <p style="color: green; font-family: 'arial', cursive; font-size: 16px;">
                                    {{ $registro_completof->mascot_clie->nombre }}
                                </p>
                            @endif
                            <hr>
                            <label class="form-label">NOMBRE DE LA MASCOTA <span class="text-danger">*</span></label>
                            @if ($registro_completof)
                                <p style="color: green; font-family: 'arial', cursive; font-size: 16px;">
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
                                    <button type="button" wire:click="LimpiarDatosproductof" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    @if ($Searchproductof && $bloque == false)
                                        <button class="btn btn-info" wire:click="crearProducto"><i
                                                class="bx bx-plus"></i></button>
                                    @endif
                                </div>
                                @error('Searchproductof')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <br>
                                @if ($Searchproductof && $bloque == false)
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
                            <div class="col-md-8">
                                <label class="form-label"> Unidad
                                    <span class="text-danger">*</span></label>
                                <select class="form-select" wire:model="UnidadFarmacia">
                                    <option value="">
                                        [SELECCIONE UNA OPCIÓN]
                                    </option>
                                    {{-- <option value="unidad">unidad
                                    </option>
                                    <option value="ml">ml
                                    </option>
                                    <option value="mg">mg
                                    </option>
                                    <option value="gr">gr
                                    </option> --}}
                                    <option value="FRASCO">-- FRASCO --
                                    </option>
                                    <option value="TABLETA">-- TABLETA --
                                    </option>
                                    <option value="CAPSULAS">-- CAPSULAS --
                                    </option>
                                    <option value="GOTERO">-- GOTERO --
                                    </option>
                                    <option value="SOBRES">-- SOBRES --
                                    </option>

                                </select>
                                @error('UnidadFarmacia')
                                    <div class="text-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="form-label">Costo
                                        <span class="text-danger">*</span></label>
                                    <input class="form-control" wire:model="CostoFarmacia" type="number">
                                    @error('CostoFarmacia')
                                        <div class="text-danger">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">Cantidad
                                        <span class="text-danger">*</span></label>
                                    <input class="form-control" wire:model="CantidadFarmacia" type="number">
                                    @error('CantidadFarmacia')
                                        <div class="text-danger">
                                            {{ $message }}</div>
                                    @enderror
                                </div>



                            </div>
                            <div class="row mt-2">

                                <button type="button" class="btn btn-success waves-effect"
                                    wire:click="vendercarro">VENDER</button>
                            </div>
                        </div>

                        <hr>
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-hover border-primary">
                                <thead>
                                    <tr class="text-center">
                                        {{-- <th>ID</th> --}}
                                        <th>Nombre</th>
                                        <th>U. de medida</th>
                                        <th>Cantidad</th>
                                        <th>Precio de venta </th>
                                        <th>SubTotal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($farmaciaventas as $datos)
                                        @if ($registro_completof)
                                            @if ($datos->mascota_id == $registro_completof->id)
                                                <tr class="text-center">
                                                    {{-- <td>{{ $datos->id }}</td> --}}
                                                    <td>{{ $datos->productos_famaciaven->nombre }}</td>
                                                    <td>{{ $datos->unidad }}</td>
                                                    <td>
                                                        {{ $datos->cantidad }}
                                                        {{-- {{ intval($datos->cantidad)}} --}}
                                                    </td>
                                                    <td>
                                                        {{ $datos->precio }}
                                                    </td>
                                                    <td>
                                                        {{ $datos->cantidad * $datos->precio }} Bs.
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-sm btn-danger"
                                                            wire:click.prevent="$emit('eliminarcarro', {{ $datos->id }})"><i
                                                                class="bx bxs-trash"></i></button>

                                                        {{-- <button class="btn btn-sm btn-warning"
                                                        wire:click="editarcarroventa({{ $datos->id }})">
                                                        <i class="bx bxs-pencil"></i>
                                                    </button> --}}
                                                    </td>
                                                </tr>
                                                {{-- <p id="parrafo_oculto" style="display: none;"> {{ $totalprecio += $datos->cantidad*$datos->precio }}</p> --}}
                                                @php
                                                    $totalprecio += $datos->cantidad * $datos->precio;
                                                @endphp
                                            @endif
                                        @endif
                                    @endforeach
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total -> </td>
                                    <td class="text-center">
                                        {{ $totalprecio }} Bs.
                                    </td>
                                    <td></td>


                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                            wire:click="cerarFarmacias">SALIR</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
