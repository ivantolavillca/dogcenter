    <div wire:ignore.self id="" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content radius-10 border-start border-5  border-primary">
                <div class="modal-header">
                    @if (true)
                    <div class="row">
                        <div class="text-center text-info h5"> REGISTRAR CIRUGIA</div>
                    </div>
                    @endif
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" wire:model="Idprovedor">
                            <label class="form-label">NOMBRE DEL DUEÑO DE LA MASCOTA <span class="text-danger">*</span></label>
                            @if($registro_completof)
                            <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                {{ $registro_completof->mascot_clie->nombre }}
                            </p>
                            @endif
                            <hr>
                            <label class="form-label">NOMBRE DE LA MASCOTA <span class="text-danger">*</span></label>
                            @if($registro_completof)
                            <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                {{ $registro_completof->nombre }}
                            </p>
                            @endif
                            <hr>
                            <label class="form-label">SEXO DE LA MASCOTA <span class="text-danger">*</span></label>
                            @if($registro_completof)
                            <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                {{ $registro_completof->sexo }}
                            </p>
                            @endif
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">PESO DE LA MASCOTA<span class="text-danger">*</span></label>
                            @if($registro_completof)
                            <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                @if($registro_completof->peso)
                                {{ $registro_completof->peso }}
                                @else
                                Sin datos
                                @endif
                            </p>
                            @endif
                            <hr>
                            <label class="form-label">EDAD DE LA MASCOTA<span class="text-danger">*</span></label>
                            @if($registro_completof)
                            <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                {{ $registro_completof->edad_mascota }}
                            </p>
                            @endif
                            <hr>
                            <label class="form-label">DESCRIPCION DE LA CIRUGIA<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="descripcion" placeholder="Ej. radiografia">
                            @error('descripcion')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="limpiarmodalcirugia">CANCELAR</button>
                        <button wire:click="GuardarCirugia" type="button" class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button>

                    </div>
                </div>
            </div>
        </div>
    </div>