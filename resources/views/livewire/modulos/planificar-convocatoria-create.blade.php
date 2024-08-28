<div>
    <button  class="btn btn-outline-primary waves-effect waves-light col-md-6 " data-bs-toggle="modal" data-bs-target="#agregarconvocatoria"> <i class="bx bxs-plus-circle">AGREGAR</i></button>



   
    
  
</div>
@push('javas')
<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('closeModal', function () {
            $('#agregarconvocatoria').modal('hide');
        });
    });
</script>  
@endpush
