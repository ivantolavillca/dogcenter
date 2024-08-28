    <div wire:ignore.self id="modalcirugia" data-bs-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
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
                            <label class="form-label text-info">NOMBRE DEL DUEÑO <span class="text-danger">*</span></label>
                            @if($registro_completo)
                            <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                {{ $registro_completo->mascot_clie->nombre }}
                            </p>
                            @endif
                            <hr>
                            <label class="form-label text-info">NOMBRE DE LA MASCOTA <span class="text-danger">*</span></label>
                            @if($registro_completo)
                            <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                {{ $registro_completo->nombre }}
                            </p>
                            @endif
                            <hr>
                            <label class="form-label text-info ">SEXO DE LA MASCOTA <span class="text-danger">*</span></label>
                            @if($registro_completo)
                            <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                {{ $registro_completo->sexo }}
                            </p>
                            @endif
                            <hr>
                            <label class="form-label text-info">ASA<span class="text-danger">*</span></label>
                            <select class="form-control" wire:model="asa" placeholder="Selecciona...">
                                <option value="">Selecciona...</option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="IV">IV</option>
                                <option value="V">V</option>
                            </select>
                            @error('asa')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-info">PESO DE LA MASCOTA<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="pesocirugia" placeholder="Ej. 2 Kilos">
                            @error('pesocirugia')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                            <label class="form-label text-info">EDAD DE LA MASCOTA<span class="text-danger">*</span></label>
                            @if($registro_completo)
                            <p style="color: green; font-family: 'Comic Sans MS', cursive; font-size: 16px;">
                                {{ $registro_completo->edad_mascota }}
                            </p>
                            @endif
                            <hr>
                            <label class="form-label text-info">DESCRIPCION DE LA CIRUGIA<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="descripcion" placeholder="Ej. Esterilización">
                            @error('descripcion')
                            <div class="text-danger ">{{ $message }}</div>
                            @enderror
                            <hr>
                            <label class="form-label text-info">PRECIO DE LA CIRUGIA<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" wire:model="costocirugia" placeholder="Ej. 500 Bs">
                            @error('costocirugia')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <hr>
                        </div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect" data-bs-dismiss="modal" wire:click="limpiarmodalcirugia">CANCELAR</button>

                        @if($id_cirugiaEdita)
                        <button wire:click="GuardarCirugiaeditarf" type="button" class="btn btn-warning waves-effect waves-light">GUARDAR DATOS</button>
                        @else
                        <button wire:click="GuardarCirugia" type="button" class="btn btn-success waves-effect waves-light">GUARDAR DATOS</button>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>