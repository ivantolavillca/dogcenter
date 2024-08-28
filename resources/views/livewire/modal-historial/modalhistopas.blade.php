<div wire:ignore.self id="modalhistoriales" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="capturarImagenModalLabel" aria-hidden="false">

    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-10 border-start border-5  border-primary">
            <div class="modal-header">
                <div class="row">
                    <div class="text-center text-info h5"> REGISTRAR HISTORIALES ANTIGUOS</div>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">NOMBRE DEL DUEÑO<span class="text-danger">*</span></label>
                        @if ($registro_completoh)
                            <p>{{ $registro_completoh->mascot_clie->nombre }}</p>
                        @endif
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">NOMBRE DE LA MASCOTA <span class="text-danger">*</span></label>
                        @if ($registro_completoh)
                            <p>{{ $registro_completoh->nombre }}</p>
                        @endif
                        <hr>
                    </div>
                    <div class="col-md-0">
                        <label class="form-label">INTRODUZCA UNA DESCRIPCIÓN <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" wire:model="descripcion"
                            placeholder="Ej. radiografia">
                        @error('descripcion')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br>
                    </div>
                </div>
                @if (!$a)
                    <div class="col-md-{{ $historial_id_selected ? '12' : '4' }}">
                        <label class="form-label">Ingrese una
                            {{ $historial_id_selected ? 'nueva' : '' }} imagen o pdf</label>
                        <select class="form-select"wire:model='SeleccionTipoDeArchivo'>
                            <option value="">[Seleccione una opción]</option>
                            <option value="pdf">Subir un Archivo Pdf </option>
                            <option value="imagen">Subir un Archivo imagen</option>
                            <option value="usarcamara">Subir una imagen desde camara</option>
                        </select>
                        @error('errortipodedato')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                <div class="col-md-12">
                    @if ($SeleccionTipoDeArchivo != '')
                        <hr>
                        @if ($SeleccionTipoDeArchivo =='imagen')
                            <div class="modal-body">
                                <div class="col mb-3">
                                    <label class="form-label">SUBIR o IMAGEN</label>
                                    <div>
                                        @if (session()->has('success'))
                                            <div>{{ session('success') }}</div>
                                        @endif
                                        <input type="file" class="form-control" wire:model="archivosPdfciru" multiple>
                                        @error('archivosPdfciru')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                             
                            </div>
                        @elseif ($SeleccionTipoDeArchivo == 'pdf')
                            <label class="form-label"> Debe seleccionar el archivo pdf que
                                desea añadir a la mascota</label>
                                <input type="file" class="form-control"
                                wire:model="archivosPdfciru">
                                @error('archivosPdfciru')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                        
                        @elseif($SeleccionTipoDeArchivo == 'usarcamara')
                            <div class="col-md-12">
                                <label class="form-label">IMAGEN DEL HISTORIAL <span class="text-info">(capturar desde
                                        la
                                        cámara)</span> <span class="text-danger">*</span></label>
                                @if ($a == true)
                                    <div class="text-center">
                                        <button class="btn btn-sm btn-danger" wire:click="limpiarbotonpro">
                                            REMOVER IMAGEN
                                        </button>
                                    </div>
                                @else
                                    @include('livewire.modal-historial.modcamara')
                                @endif
                                @if ($rutaImagenfinal)
                                    <span class="d-block text-center text-secondary">
                                        <img src="{{ $rutaImagenfinal }}" alt="Imagen del Producto" class="img-fluid">
                                    </span>
                                @else
                                    <div class="text-center">
                                        <h1>SIN IMAGEN CAPTURADA </h1>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endif
                </div>
                <hr>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal"
                        wire:click="limpiarmodalhistop">CANCELAR</button>
                    <button wire:click="GuardarImagenes" type="button"
                        class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button>
                </div>
            </div>
        </div>
    </div>
</div>
