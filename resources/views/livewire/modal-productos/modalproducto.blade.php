    <div wire:ignore.self id="idmodalproducto" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">

        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-10 border-start border-5  border-primary">
                <div class="modal-header">
                    @if($productoID)
                    <div class="row">
                        <div class="text-center text-info h5"> EDITAR PRODUCTOS</div>
                    </div>
                    @else
                    <div class="row">
                        <div class="text-center text-info h5"> REGISTRAR PRODUCTOS</div>
                    </div>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" wire:model="productoID">
                        <div class="col-md-6">
                            <label class="form-label">NOMBRE DEL PRODUCTO <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model.live="Nombreproducto" placeholder="Ej. suero">
                            @error('Nombreproducto')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">DESCRIPCION DEL PRODUCTO <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model.live="Descripcionproducto" placeholder="Ej. sirve para la recuperacion">
                            @error('Descripcionproducto')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">IMAGEN DEL PRODUCTO subir <span class="text-danger">*</span></label>

                            <input type="file" wire:model="Imagenproducto" accept=".pdf,.jpg,.png,.jpeg" @if($campoImagenHabilitado) disabled @endif>
                            <span class="d-block text-center text-secondary ">
                                @if($Imagenproducto)
                                DATOS CARGADOS CON EXITO
                                @php
                                $a=true;
                                @endphp
                                @else
                                SIN DATOS
                                @endif
                            </span>
                            @error('Imagenproducto')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">IMAGEN DEL PRODUCTO (capturar desde la cámara) <span class="text-danger">*</span></label>
                            @if($productoID)
                            @if($b==true)
                            <div wire:ignore.self>
                                <button class="btn btn-sm btn-danger" wire:click="limpiarbotonpro">
                                    REMOVER IMAGEN
                                </button>
                            </div>
                            @else
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#capturarImagenModal">
                                Capturar Imagen Editar
                            </button>
                            @endif
                            @else
                            @if($a==true)
                            <div wire:ignore.self>
                                <button class="btn btn-sm btn-danger" wire:click="limpiarbotonpro">
                                    REMOVER IMAGEN
                                </button>
                            </div>
                            @else
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#capturarImagenModal">
                                Capturar Imagen Nueva
                            </button>
                            @endif
                            @endif
                            <!-- Mostrar la imagen capturada en un span -->
                            @if($rutaImagenfinal)
                            <span class="d-block text-center text-secondary">
                                <img src="{{$rutaImagenfinal}}" alt="Imagen del Producto" class="img-fluid">
                            </span>
                            @else
                            <h1>SIN IMAGEN CAPTURADA </h1>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">UNIDAD DE MEDIDA <span class="text-danger">*</span></label>
                            <select class="form-select" wire:model.live="uni_medida">
                                <option value="unidad">Selecciona una unidad de medida</option>
                                <option value="unidad">Unidad</option>
                                <option value="ml">ml</option>
                                <option value="frascom">Frasco comprimido</option>
                                <!-- Agrega más opciones según tus necesidades -->
                            </select>
                            @error('uni_medida')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        </div>
                        <div class="col-md-6">
                           
                            <label class="form-label text-info">CANTIDAD EN
                                @if($uni_medida == 'ml')
                                MILILITROS
                                @elseif($uni_medida == 'frascom')
                                FRASCO COMPRIMIDO
                                @else
                                UNIDAD
                                @endif
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" wire:model.live="Cantidadproducto" placeholder="Ej. 10">
                            @error('Cantidadproducto')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        </div>
                        <div class="col-md-6">
                    
                            <label class="form-label text-info">PRECIO DEL PRODUCTO POR
                                @if($uni_medida == 'ml')
                                MILILITROS
                                @elseif($uni_medida == 'frascom')
                                FRASCO COMPRIMIDO
                                @else
                                UNIDAD
                                @endif
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" wire:model.live="Precioproducto" placeholder="Ej. 25.50">
                            @error('Precioproducto')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        </div>

                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="limpiarproducto">CANCELAR</button>
                        @if($productoID)
                        @if($campoImagenHabilitado)
                        <button wire:click="btnEditarprodcuto2" type="button" class="btn btn-warning waves-effect waves-light">EDITAR DATOS CAPTURA </button>
                        @else
                        <button wire:click="btnEditarprodcuto" type="button" class="btn btn-warning waves-effect waves-light">EDITAR DATOS </button>
                        @endif
                        @else
                        @if($campoImagenHabilitado)
                        <button wire:click="Guardarprodcuto2" type="button" class="btn btn-warning waves-effect waves-light">GUARDAR DATOS CAPTURA</button>
                        @else
                        <button wire:click="Guardarprodcuto" type="button" class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>