<div wire:ignore.self id="modaltratamiento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content radius-10 border-start border-5 border-primary">
            <!-- Contenido del modal -->
            <div class="modal-body">
                <div class="text-center">
                    <h4>Detalle de Tratamientos</h4>
                    <div>
                        <button class="btn btn-danger mr-2" wire:click="LimpiarmodalTabla">
                            <i class="bx bx-exit"></i> SALIR
                        </button>
                    </div>
                </div>


                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Estado</th>
                            <th>Doctor</th>
                            <th>Medicamentos</th>
                            <th>Fecha</th>
                            <th>Precio</th>
                            <!-- Añade más encabezados de columnas según tu necesidad -->
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí se cargarán las filas de la tabla -->
                        @if ($this->datamodal)
                            @foreach ($datamodal as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    
                                    <td>{{ $item->estado}}</td>
                                    <td>{{ $item->tratamiento_doctor->name }}</td>
                                    <td>
                                        <ul>
                                            @if($item->tratamiento_medicamentos)
                                                @foreach($item->tratamiento_medicamentos as $item2)
                                                    <li>{{ $item2->Medicamento }}</li>
                                                @endforeach
                                            @else
                                            <li>sin datos</li>
                                            @endif
                                        </ul>
                                        

                                    </td>


                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->precio }}</td>
                                    <td>{{ $item->cantidad * $item->precio }}</td>
                                    <!-- Añade más columnas según tu necesidad -->
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tr>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                        <th>-</th>
                        <th>Total</th>
                        <th>{{ $totalDinero }}</th>
                        <!-- Añade más encabezados de columnas según tu necesidad -->
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>
