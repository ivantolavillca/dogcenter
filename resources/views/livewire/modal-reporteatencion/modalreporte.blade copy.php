<div wire:ignore.self id="modalatencion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-10 border-start border-5 border-primary">
            <!-- Contenido del modal -->
            <div class="modal-body">
                <div class="text-center">
                    <h4>Detalle de Atenciones</h4>
                    <div>
                        <h1>
                            {{$Idatencion}}:
                            {{$nombre_usu}}
                        </h1>
                        @if($Idatencion && $fecha1 && $fecha2 )
                            <button wire:click="imprimirPorFecha" class="btn btn-primary ficha-clinica rounded-pill" target="_blank">
                                <i class="fas fa-print"></i> Imprimir por fecha
                            </button>
                            @if(session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif

                        @elseif($Idatencion && $fecha1)
                            <button wire:click="imprimirPorFecha" class="btn btn-primary ficha-clinica rounded-pill" target="_blank">
                                <i class="fas fa-print"></i> Imprimir por fecha
                            </button>

                            @if(session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                        @elseif($Idatencion && $fecha2)
                            <button wire:click="imprimirPorFecha" class="btn btn-primary ficha-clinica rounded-pill" target="_blank">
                                <i class="fas fa-print"></i> Imprimir por fecha
                            </button>

                            @if(session()->has('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                        @elseif($Idatencion)
                        <a href="{{ route('imprimiratendidos', ['f1' => $fecha2 ?? 0, 'f2' => $fecha2 ?? 0, 'id_u' => $Idatencion]) }}" class="btn btn-primary ficha-clinica rounded-pill" target="_blank">
                            <i class="fas fa-print"></i> Imprimir todo
                        </a>
                        @endif


                        <button class="btn btn-danger mr-2" wire:click="LimpiarmodalTabla">
                            <i class="bx bx-exit"></i> SALIR
                        </button>
                        <button class="btn btn-danger mr-2" wire:click="LimpiarFechas">
                            <i class="bx bx-exit"></i> LIMPIAR FECHAS
                        </button>
                        <input type="date" class="form-control" wire:model="fecha1" placeholder="Fecha 1" {{ $lim ? 'enabled' : 'disabled' }}>
                        <input type="date" class="form-control mt-2" wire:model="fecha2" placeholder="Fecha 2" {{ $lim2 ? 'enabled' : 'disabled' }}>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre de la mascota</th>
                                <th>Dueño de la mascota</th>
                                <th>Nombre del Doctor</th>
                                <th>Correo del Doctor</th>
                                <th>Fecha de Atencion</th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí se cargarán las filas de la tabla -->
                            @if(isset($dato2) && $dato2->count() > 0)
                            @foreach($dato2 as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->ficha_mascota->nombre}}</td>
                                <td>{{ $item->ficha_mascota->mascot_clie->nombre}}</td>
                                <td>{{ $item->ficha_usuario->name}}</td>
                                <td>{{ $item->ficha_usuario->email}}</td>
                                <td>{{ $item->created_at }}</td>

                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                        <tr>
                            <th>-</th>
                            <th>-</th>
                            <th>-</th>
                            <th>-</th>
                            <th>Total de Dias</th>
                            <th>{{$totalDias}} Dias</th>


                            <!-- Añade más encabezados de columnas según tu necesidad -->
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>