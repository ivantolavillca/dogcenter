<div>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">ADMINISTRACIÓN ESTUDIANTE</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active"> Estudiante</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if (count($materiasInscritas) > 0)

                        <div class="row">
                            <div class="text-center">
                                <h4>RECORD ACADÉMICO</h4>
                            </div>

                            <div class="col-4">

                                <br>
                                {{-- <a href="{{route('reporteestudiante',$persona_auth->id_persona_siadi)}}" target="_blank" class="btn btn-success"
                                    >IMPRIMIR RECORD
                                    <i class="bx bx-printer"></i></a> --}}
                                <button class="btn btn-success"
                                    wire:click="imprimir_record({{ $persona_auth->id_persona_siadi }})">IMPRIMIR RECORD
                                    <i class="bx bx-printer"></i></button>
                               


                            </div>

                        </div>
                        @if (count($materiasInscritas) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>IDIOMA</th>
                                            <th>PARALELO</th>
                                            <th>NOTA</th>
                                            <th> ESTADO</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($materiasInscritas as $materia)
                                            <tr>
                                                <td>{{ $materia->nombre_idioma }} {{ $materia->nombre_nivel_idioma }}
                                                </td>
                                                <td> {{ $materia->nombre_paralelo }} {{ $materia->turno_paralelo }}</td>
                                                <td>
                                                    {{ $materia->final_nota }}
                                                </td>
                                                <td>{{ $materia->observacion_nota }}</td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>

                            </div>

                        @endif



                    @endif

                 




                </div>
            </div>

        </div>
    </div>
</div>
