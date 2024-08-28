<div>
    <button wire:click="abrirModal" class="btn btn-outline-primary waves-effect waves-light col-md-6 " data-bs-toggle="modal" data-bs-target="#agregarusuario"> <i class="bx bxs-plus-circle">AGREGAR</i></button>
    <div wire:ignore.self id="agregarusuario" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0" id="myModalLabel">AGREGAR USUARIO
                                                        </h5>
                                                        
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">C.I.:</label>
                                                                        <input type="text" class="form-control" id="ci" placeholder="Ingrese su cedula de identidad">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">NOMBRE:</label>
                                                                        <input type="text" class="form-control" id="nombre" placeholder="Ej. Chapi">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">PATERNO:</label>
                                                                        <input type="text" class="form-control" id="paterno" placeholder="Ej. Junior">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">MATERNO:</label>
                                                                        <input type="text" class="form-control" id="materno" placeholder="Ej. Simp">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        
                                                       
                                                      
                                                    </div>
                                                   
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
</div>
@section('scribd')
<script>
  $(document).ready(function() {
    $('#ci').on('input', function() {
        var ci = $(this).val();
        if (ci.length >= 3) {
            $.ajax({
                url: '/admin/autocomplete',
                type: 'GET',
                data: { ci: ci },
                dataType: 'json',
                success: function(response) {
                    if (response.length > 0) {
                        var persona = response[0];
                        $('#nombre').val(persona.nombre).attr('disabled','disabled');
                        $('#paterno').val(persona.paterno).attr('disabled','disabled');
                        $('#materno').val(persona.materno).attr('disabled','disabled');
                    } else {
                        $('#nombre').val('').attr('enabled','enabled');
                        $('#paterno').val('');
                        $('#materno').val('');
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        } else {
            $('#nombre').val('');
            $('#paterno').val('');
            $('#materno').val('');
        }
    });
});
</script>   
@endsection
</div>
