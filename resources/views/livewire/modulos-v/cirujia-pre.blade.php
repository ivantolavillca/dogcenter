<div>
    <button id="btnGroupVerticalDrop1" type="button" class="btn btn-secondary  dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        CIRUGIA <i class="mdi mdi-chevron-down"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
     @if($clientess)
        @foreach ($clientess->cliente_mascotas as $masc)
        <button class="dropdown-item" wire:click="crearcirugias({{$masc->id}})">{{ $masc->nombre }}
        </button>
        @endforeach
     @endif
    </div>
    @include('livewire.modal-cirugia.modalcirugiapre')
    @include('livewire.modal-cirugia.modalcirugia')
</div>
@push('molqui-js')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('cerrarmodalcirugiapre', function() {
            $('#modalcirugiapre').modal('hide');
        });
        Livewire.on('abrirmodalcirugiapre', function() {
            $('#modalcirugiapre').modal('show');
        });

        Livewire.on('cerrarmodalcirugia', function() {
            $('#modalcirugia').modal('hide');
        });
        Livewire.on('abrirmodalcirugia', function() {
            $('#modalcirugia').modal('show');
        });
    });

   
</script>
@endpush