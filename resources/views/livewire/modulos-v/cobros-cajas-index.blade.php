<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">


                    <div class="mb-3 row">


                        <div class="col-12 row">
                            <div class="col-12 col-md-6 ">
                                <label for="gestiones" class="form-label">Filtrar por fecha: </label>
                                <input type="date" class="form-control" wire:model="fechabusqueda">
                                {{-- <input type="text" class="form-control" wire:model="search"> --}}

                            </div>


                            <div class="col-12 col-md-6 mt-4">
                              <button class="btn btn-info" wire:click="ResetFecha">Mostrar todo</button>

                            </div>


                        </div>
                        <div class="row mt-5">

                            <div class="accordion accordion-flush " id="accordionFlushExample">
                                @foreach ($cajas as $ca)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header border border-5" id="flush-headingOne{{ $ca->id }}">
                                            <b> <span class="btn btn-outline-primary"> CAJA EN FECHA -
                                                {{ \Carbon\Carbon::parse($ca->created_at)->isoFormat('LL') }}</span>
                                        </b> <b> <span class="btn btn-outline-success"> ENCARGADO Dr.
                                                {{ $ca->usuario->name }}</span> </b>
                                            <button class="accordion-button collapsed  " type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseOne{{ $ca->id }}"
                                                aria-expanded="false"
                                                aria-controls="flush-collapseOne{{ $ca->id }}">
                                                
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne{{ $ca->id }}"
                                            class="accordion-collapse collapse border border-5"
                                            aria-labelledby="flush-headingOne{{ $ca->id }}" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">

                                                <div class="col-md-12">
                                                    @if (count($ca->cobros) > 0)
                                                        <div class="table-responsive mt-5">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr class="bg-dark">
                                                                        <th>ENCARGADO DEL COBRO</th>
                                                                        <th>MOTIVO</th>
                                                                        <th>CLIENTE</th>
                                                                        <th>COSTO DEL COBRO</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $sumacobro = 0;
                                                                    @endphp
                                                                    @foreach ($ca->cobros as $c)
                                                                        <tr> 
                                                                            <td>{{ $c->usuario->name }}</td>
                                                                            <td>{{ $c->motivo }}</td>
                                                                            <td>{{ $c->cliente->nombre }}
                                                                                {{ $c->cliente->apellidos }}</td>
                                                                            <td>{{ $c->costo }} Bs.</td>
                                                                        </tr>
                                                                        @php
                                                                            $sumacobro = $sumacobro + $c->costo;
                    
                                                                        @endphp
                                                                    @endforeach
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>TOTAL</td>
                                                                        <td>{{ $sumacobro }} Bs.</td>
                                                                    </tr>
                                                                    @if (count($ca->descuentos) > 0)
                                                                        <tr class="bg-dark text-center">
                                                                            <td></td>
                                                                            <td>GASTOS</td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr class="bg-dark">
                                                                            <td>ENCARGADO</td>
                                                                            <td>RAZON</td>
                                                                          
                                                                            <td></td>
                                                                            <td>MONTO DESCUENTO</td>
                                                                        </tr>
                                                                        @php
                                                                            $sumagasto = 0;
                                                                        @endphp
                                                                        @foreach ($ca->descuentos as $d)
                                                                            <tr>
                                                                                <td>{{ $d->usuario->name }}</td>
                                                                                <td>{{ $d->razon }}</td>
                                                                                
                    
                                                                                <td></td>
                                                                                <td>{{ $d->costo }} Bs.</td>
                                                                            </tr>
                                                                            @php
                                                                                $sumagasto = $sumagasto + $d->costo;
                    
                                                                            @endphp
                                                                        @endforeach
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td>TOTAL</td>
                                                                            <td>{{ $sumagasto }} Bs.</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td class="text-primary">TOTAL EN LA CAJA </td>
                                                                            @php
                                                                                $totalcaja = $sumacobro - $sumagasto;
                                                                            @endphp
                                                                            <td>
                                                                                <b class="text-primary"> {{ $totalcaja }} Bs.
                                                                                </b>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                    
                                                                </tbody>
                                                            </table>
                    
                                                        </div>
                    
                                                    @endif
                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                {{-- <div class="accordion-item">
                                  <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed text-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                      Accordion Item #2
                                    </button>
                                  </h2>
                                  <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                                  </div>
                                </div>
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="flush-headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                      Accordion Item #3
                                    </button>
                                  </h2>
                                  <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                                  </div>
                                </div> --}}
                            </div>
                            {{ $cajas->links() }}
                        </div>



                    </div>

                </div>

            </div>



        </div>
    </div>
</div>
