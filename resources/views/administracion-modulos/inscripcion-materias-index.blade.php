@extends('layouts.admin_principal')

@section('body')


    <div>

        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">PREINSCRIPCIONES</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">preinscripcion</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="mb-3 row">



                            <br>
                            <br>
                            <br>
                            <div class="col-md-12">



                        <div class="col-md-6">
                            <a href="{{route('inscripcion_user_edit.create',$persona->id_siadi_persona )}}" class="btn btn-outline-primary waves-effect waves-light col-md-6 "
                                > <i
                                    class="bx bxs-plus-circle">AGREGAR</i></a>
                          


                        </div>

                            </div>


                        </div>

                        <br>



                        @if ($materias->count())
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">

                                    <thead>
                                        <tr>

                                            <th>
                                                N°
                                            </th>

                                            <th>
                                                NOMBRE ESTUDIANTE
                                            </th>


                                            <th>
                                                ACCIÓNES
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $cont = 1;
                                        @endphp
                                        @foreach ($materias as $inscripcion)
                                            <tr>

                                                <th>
                                                    @php
                                                        echo $cont;
                                                        $cont++;
                                                    @endphp
                                                </th>


                                                <td>
                                                    {{ $inscripcion->planificar_paralelo->planificar_asignatura->siadi_asignatura->idioma->nombre_idioma }}
                                                    {{ $inscripcion->planificar_paralelo->planificar_asignatura->siadi_asignatura->nivel_idioma->nombre_nivel_idioma }}
                                                    {{ $inscripcion->planificar_paralelo->planificar_asignatura->siadi_asignatura->nivel_idioma->descripcion_nivel_idioma }}
                                                    {{ $inscripcion->planificar_paralelo->turno_paralelo }}
                                                    {{ $inscripcion->planificar_paralelo->paralelo->nombre_paralelo }}
                                                </td>


                                                <td>



                                                    <a href="{{route('inscripcion_user_edit.index',$inscripcion->id_inscripcion )}}"type="button"
                                                        class="btn btn-outline-success waves-effect waves-light">
                                                        <i class="fa fa-edit"></i></a>

                                                </td>
                                                <td>
                                                    {{-- <a href="{{route('')}}"type="button"
                                                        class="btn btn-outline-primary waves-effect waves-light">
                                                        <i class="fa fa-book"></i></a> --}}

                                                    {{-- @if ($insc->observacion_inscripcion == 'INSCRITO')
                                                    <button type="button"
                                                        class="btn btn-outline-success waves-effect waves-light">
                                                        INSCRITO
                                                    </button>
                                                @else --}}
                                                    {{-- @if ($personapreinscrit->persona_preinscrita->count() === $personapreinscrit->persona_preinscrita->where('observacion_inscripcion', 'INSCRITO')->count())
    PERSONA INSCRITA
@else
    <button type="button"
            class="btn btn-outline-primary waves-effect waves-light"
            wire:click.prevent="$emit('inscribirestudiante', {{ $personapreinscrit->id_siadi_persona }})">
        INSCRIBIR
    </button>
@endif --}}

                                                    {{-- @endif --}}
                                                    {{-- <a href="{{ route('imprimir_reporte_preinscripcion', $insc->id_pre_inscripcion) }}"
                                                        type="button"
                                                        class="btn btn-outline-danger waves-effect waves-light"> <i
                                                            class="fa fa-print"></i>
                                                    </a> --}}
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="d-flex justify-content-center">

                                {{ $materias->links() }}
                            </div>
                        @else
                            <div class="px-5 py-3 border-gray-200  text-sm">
                                <strong>No hay Registros</strong>
                            </div>
                        @endif
                    </div>


                </div>
                @push('navi-js')
                    <script>
                        livewire.on('inscribirestudiante', id_preinscripcion => {
                            Swal.fire({
                                title: 'Esta seguro de inscribir al Estudiante?',
                                text: "¡No podrás revertir esto!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: '¡Sí, inscribir a las materias!'
                            }).then((result) => {
                                if (result.isConfirmed) {

                                    // livewire.emitTo('servidor-index', 'delete', ServidorId);
                                    livewire.emit('inscripbir', id_preinscripcion);


                                }
                            })
                        });
                    </script>
                @endpush



            @endsection
