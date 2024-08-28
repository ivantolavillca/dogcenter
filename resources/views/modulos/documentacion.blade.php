@extends('layouts.admin_principal')
@section('body')
<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title mb-0 font-size-18">Documentación A.D.M.I.N.</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home.index') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Documentación A.D.M.I.N.</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center" id="admin.home.index">admin.home.index</h2>
                    <div class="row">
                        <div class="col-md-7">
                            <img class="img-fluid" alt="Imagen admin.home.index" src="admin.home.index.jpg" data-holder-rendered="true">
                        </div>
                        <div class="col-md-5">
                            <p><b>Controlador</b> <span class="badge bg-black text-success">App\Http\Controllers\HomeController</span></p>
                            <p>Dashboard de Inicio donde pueden estar habilitados las siguientes vistas</p>
                            <ul>
                                <li><a href="#estadisticas.detalladas">estadisticas.detalladas</a></li>
                            </ul>
                            <p><b>Nota:</b> En caso de los roles Admin, Kardex y Docente al estar habilitado el el permiso se mostrar un cuadro resumen de:</p>
                            <ul>
                                <li><b>TOTAL POR MODALIDAD</b> Donde se muestra el total de estudiantes inscritos en todas las gestiones agrupados por modalidad. Los estudiantes inscritos contempla los estudiantes inscritos en la gestion actual, aprobados, reprobados y los que no se presentaron.</li>
                                <li><b>TOTAL POR GÉNERO </b>Se agrupan los estudiantes inscritos por género.</li>
                            </ul>
                            <img class="img-fluid" src="admin.home.index_1.jpg" alt="Imagen ">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-xl-6">
                            <div class="card bg-soft-secondary">
                                <img class="card-img-top img-fluid" src="{{asset('assets/docum/estadisticas.detalladas.jpg')}}" alt="Card image cap">
                                <div class="card-body">
                                    <h3 class="card-title mt-0" id="estadisticas.detalladas">estadisticas.detalladas</h3>
                                    <p class="card-text">Este permiso permite listar los estudiantes inscritos por cada gestión y periodo, donde se muestran los aprobados, reprobados, no se presentaron e inscritos. Se pueden encontrar los siguientes datos:</p>
                                    <ul>
                                        <li>ÚLTIMAS 15 CONVOCATORIAS POR <b>PERIODO GESTIÓN</b></li>
                                        <li><b>PERIODO GESTIÓN</b> INDIVIDUAL DE UN PERIODO</li>
                                        <li><b>CONVOCATORIA ESTUDIANTE</b> POR MODALIDAD</li>
                                        <li>POR <b>SIADI ASIGNATURAS</b> DE UNA MODALIDAD</li>
                                        <li>por <b>SIADI ASIGNATURA NIVELES</b> DE UNA ASIGNATURA</li>
                                    </ul>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Cras justo odio</li>
                                    <li class="list-group-item">Dapibus ac facilisis in</li>
                                </ul>
                                <div class="card-body">
                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center" id="role.index">role.index</h2>
                    <div class="row">
                        <div class="col-md-7">
                            <img class="img-fluid" alt="Imagen role.index" src="{{asset('assets/docum/role.index.jpg')}}" data-holder-rendered="true">
                        </div>
                        <div class="col-md-5">
                            <p><b>Controlador</b> <span class="badge bg-black text-success">App\Http\Controllers\Admin\RoleController</span> <br>
                            <b>Vista</b> <span class="badge bg-black text-success">resources\views\vista_administracion\admin_users\role_index.blade</span></p>
                            <p><b>Controlador Livewire</b> <span class="badge bg-danger text-white">App\Http\Livewire\Admin\RoleIndex</span> <br>
                            <b>Vista Livewire</b> <span class="badge bg-primary text-white">resources\views\livewire\admin\role-index.blade</span></p>
                            <p>Aquí es donde establecemos permisos que cada uno necesita usar. Esto permite dejar al Administrador acceso a todas las características de la aplicación y clasificar a los usuarios los diferentes permisos dependiendo de su rol.</p>
                            <ul>
                                <li><a href="#role.create">role.create</a></li>
                                <li><a href="#role.edit">role.edit <b class="text-danger">falta</b></a></li>
                                <li><a href="#role.delete">role.delete <b class="text-danger">falta</b></a></li>
                            </ul>
                            
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6 col-xl-6">
                            <div class="card bg-soft-secondary">
                                <img class="card-img-top img-fluid" src="{{asset('assets/docum/role.create.jpg')}}" alt="Card role.create">
                                <div class="card-body">
                                    <h3 class="card-title mt-0" id="role.create">role.create</h3>
                                    <p class="card-text">Permiso para crear nuevos roles. Cuando este se encuentra desactivado no se muestra el botón <b>AGREGAR</b> y tampoco se renderiza en el HTML el modal de <b>CREAR ROL</b>.</p>
                                    <ul>
                                        <li><b>Nombre</b> Se define para identificar un rol. 
                                            <ul>
                                                <li>El nombre debe ser único, no puede haber roles con el mismo nombre.</li>
                                            </ul>
                                        </li>
                                        <li><b>permisos</b> Si un permiso está activo, entonces se mostrará la vista. Para mostrar la vista es necesario habilitar los que terminan en <b>*.index</b>, generalente los demas roles dependen de este. Un rol puede tener cero o más permisos.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-6">
                            <div class="card bg-soft-secondary">
                                <img class="card-img-top img-fluid" src="{{asset('assets/docum/role.edit.jpg')}}" alt="Card role.edit">
                                <div class="card-body">
                                    <h3 class="card-title mt-0" id="role.edit">role.edit</h3>
                                    <p class="card-text">Permiso para editar los roles existentes. Cuando este se encuentra desactivado no se muestra el <b>BOTON EDITAR</b> y tampoco se renderiza en el HTML el <b>MODAL EDITAR</b>.</p>
                                    <ul>
                                        <li><b>Nombre</b> Se define para cambiar identificar un rol.
                                            <ul>
                                                <li>El nombre debe ser único, no puede haber roles con el mismo nombre.</li>
                                            </ul>
                                        </li>
                                        <li><b>permisos</b> Si un permiso está activo, entonces se mostrará la vista. Para mostrar la vista es necesario habilitar los que terminan en <b>*.index</b>, generalente los demas roles dependen de este. Un rol puede tener cero o más permisos.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center" id="gestiones.index">gestiones.index</h2>
                    <div class="row">
                        <div class="col-md-7">
                            <img class="img-fluid" alt="Imagen gestiones.index" src="{{asset('assets/docum/gestiones.index.jpg')}}" data-holder-rendered="true">
                        </div>
                        <div class="col-md-5">
                            <p><b>Controlador</b> <span class="badge bg-black text-success">App\Http\Controllers\AdministracionModulos\GestionController</span> <br>
                            <b>Vista</b> <span class="badge bg-black text-success">resources\views\administracion-modulos\gestion-index.blade</span></p>
                            <p><b>Controlador Livewire</b> <span class="badge bg-danger text-white">App\Http\Livewire\AdministracionModulos\GestionIndex</span> <br>
                            <b>Vista Livewire</b> <span class="badge bg-primary text-white">resources\views\livewire\administracion-modulos\gestion-index.blade</span></p>
                            <p>En esta sección es donde se administran las gestiones, estas se muestran usan al momento de crear una planificación de convocatorias, donde solo se lístan las gestiones que esten activas.</p>
                            <ul>
                                <li><a href="#gestiones.create">gestiones.create <b class="text-danger">falta</b></a></li>
                                <li><a href="#gestiones.edit">gestiones.edit <b class="text-danger">falta</b></a></li>
                                <li><a href="#gestiones.delete">gestiones.delete <b class="text-danger">falta</b></a></li>
                                <li><a href="#gestiones.estado">gestiones.estado <b class="text-danger">falta</b></a></li>
                            </ul>
                            
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6 col-xl-6">
                            <div class="card bg-soft-secondary">
                                <img class="card-img-top img-fluid" src="{{asset('assets/docum/gestiones.create.jpg')}}" alt="Card gestiones.create">
                                <div class="card-body">
                                    <h3 class="card-title mt-0" id="gestiones.create">gestiones.create</h3>
                                    <p class="card-text">Permiso para crear nuevos gestiones. Cuando este se encuentra desactivado no se muestra el botón <b>AGREGAR</b> y tampoco se renderiza en el HTML el modal <b>AGREGAR GESTIÓN</b>.</p>
                                    <ul>
                                        <li><b>GESTION</b> Se define para identificar un año. 
                                            <ul>
                                                <li>El campo es obligatorio.</li>
                                                <li>Debe ser numérico.</li>
                                                <li>Debe tener si o si cuatro dígitos</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-6">
                            <div class="card bg-soft-secondary">
                                <img class="card-img-top img-fluid" src="{{asset('assets/docum/gestiones.edit.jpg')}}" alt="Card gestiones.edit">
                                <div class="card-body">
                                    <h3 class="card-title mt-0" id="gestiones.edit">gestiones.edit</h3>
                                    <p class="card-text">Permiso para editar las gestiones existentes. Cuando este se encuentra desactivado no se muestra los <b>botones de EDITAR</b> y tampoco se renderiza en el HTML el <b>modal EDITAR GESTION</b>.</p>
                                    <ul>
                                        <li><b>GESTION</b> Se define para identificar un año. 
                                            <ul>
                                                <li>El campo es obligatorio.</li>
                                                <li>Debe ser numérico.</li>
                                                <li>Debe tener si o si cuatro dígitos</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-6">
                            <div class="card bg-soft-secondary">
                                <img class="card-img-top img-fluid" src="{{asset('assets/docum/gestiones.delete.jpg')}}" alt="Card gestiones.delete">
                                <div class="card-body">
                                    <h3 class="card-title mt-0" id="gestiones.delete">gestiones.delete</h3>
                                    <p class="card-text">Permiso para eliminar de manera lógica las gestiones existentes, con un modal de confirmación. Cuando este se encuentra desactivado no se muestra los <b>botones de Eliminar</b>.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-6">
                            <div class="card bg-soft-secondary">
                                <img class="card-img-top img-fluid" src="{{asset('assets/docum/gestiones.estado.jpg')}}" alt="Card gestiones.estado">
                                <div class="card-body">
                                    <h3 class="card-title mt-0" id="gestiones.estado">gestiones.estado</h3>
                                    <p class="card-text">Permiso para cambiar el estado de una gestión, ya sea ACTIVO o INACTIVO. Para cambiar el estado de una  gestión solamente hacer click en uno de los <b>botones para cambiar ESTADO</b>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center" id="tipo_estudiante.index">tipo_estudiante.index</h2>
                    <div class="row">
                        <div class="col-md-7">
                            <img class="img-fluid" alt="Imagen tipo_estudiante.index" src="{{asset('assets/docum/tipo_estudiante.index.jpg')}}" data-holder-rendered="true">
                        </div>
                        <div class="col-md-5">
                            <p><b>Controlador</b> <span class="badge bg-black text-success">App\Http\Controllers\AdministracionModulos\SiadiTipoEstudianteController</span> <br>
                            <b>Vista</b> <span class="badge bg-black text-success">resources\views\administracion-modulos\tipo-estudiante-index.blade</span></p>
                            <p><b>Controlador Livewire</b> <span class="badge bg-danger text-white">App\Http\Livewire\AdministracionModulos\TipoEstudianteIndex</span> <br>
                            <b>Vista Livewire</b> <span class="badge bg-primary text-white">resources\views\livewire\administracion-modulos\tipo-estudiante-index.blade</span></p>
                            <p>En esta sección es donde se administran los tipos de estudiantes, estas se muestran usan al momento de crear una una persona.</p>
                            <ul>
                                <li><a href="#tipo_estudiante.create">tipo_estudiante.create <b class="text-danger">falta</b></a></li>
                                <li><a href="#tipo_estudiante.edit">tipo_estudiante.edit <b class="text-danger">falta</b></a></li>
                                <li><a href="#tipo_estudiante.delete">tipo_estudiante.delete <b class="text-danger">falta</b></a></li>
                                <li><a href="#tipo_estudiante.estado">tipo_estudiante.estado <b class="text-danger">falta</b></a></li>
                            </ul>
                            
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-6 col-xl-6">
                            <div class="card bg-soft-secondary">
                                <img class="card-img-top img-fluid" src="{{asset('assets/docum/gestiones.create.jpg')}}" alt="Card gestiones.create">
                                <div class="card-body">
                                    <h3 class="card-title mt-0" id="gestiones.create">gestiones.create</h3>
                                    <p class="card-text">Permiso para crear nuevos gestiones. Cuando este se encuentra desactivado no se muestra el botón <b>AGREGAR</b> y tampoco se renderiza en el HTML el modal <b>AGREGAR GESTIÓN</b>.</p>
                                    <ul>
                                        <li><b>GESTION</b> Se define para identificar un año. 
                                            <ul>
                                                <li>El campo es obligatorio.</li>
                                                <li>Debe ser numérico.</li>
                                                <li>Debe tener si o si cuatro dígitos</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-6">
                            <div class="card bg-soft-secondary">
                                <img class="card-img-top img-fluid" src="{{asset('assets/docum/gestiones.edit.jpg')}}" alt="Card gestiones.edit">
                                <div class="card-body">
                                    <h3 class="card-title mt-0" id="gestiones.edit">gestiones.edit</h3>
                                    <p class="card-text">Permiso para editar las gestiones existentes. Cuando este se encuentra desactivado no se muestra los <b>botones de EDITAR</b> y tampoco se renderiza en el HTML el <b>modal EDITAR GESTION</b>.</p>
                                    <ul>
                                        <li><b>GESTION</b> Se define para identificar un año. 
                                            <ul>
                                                <li>El campo es obligatorio.</li>
                                                <li>Debe ser numérico.</li>
                                                <li>Debe tener si o si cuatro dígitos</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-6">
                            <div class="card bg-soft-secondary">
                                <img class="card-img-top img-fluid" src="{{asset('assets/docum/gestiones.delete.jpg')}}" alt="Card gestiones.delete">
                                <div class="card-body">
                                    <h3 class="card-title mt-0" id="gestiones.delete">gestiones.delete</h3>
                                    <p class="card-text">Permiso para eliminar de manera lógica las gestiones existentes, con un modal de confirmación. Cuando este se encuentra desactivado no se muestra los <b>botones de Eliminar</b>.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-6">
                            <div class="card bg-soft-secondary">
                                <img class="card-img-top img-fluid" src="{{asset('assets/docum/gestiones.estado.jpg')}}" alt="Card gestiones.estado">
                                <div class="card-body">
                                    <h3 class="card-title mt-0" id="gestiones.estado">gestiones.estado</h3>
                                    <p class="card-text">Permiso para cambiar el estado de una gestión, ya sea ACTIVO o INACTIVO. Para cambiar el estado de una  gestión solamente hacer click en uno de los <b>botones para cambiar ESTADO</b>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection