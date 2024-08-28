           @if($Idatencion && $fecha1 && $fecha2 )
           <button wire:click="imprimirPorFecha1(3)" class="btn btn-primary ficha-clinica rounded-pill" target="_blank">
               <i class="fas fa-print"></i> Imprimir por fecha
           </button>
           @if(session()->has('error'))
           <div class="alert alert-danger">{{ session('error') }}</div>
           @endif

           @elseif($Idatencion && $fecha1)
           <button wire:click="imprimirPorFecha1(3)" class="btn btn-primary ficha-clinica rounded-pill" target="_blank">
               <i class="fas fa-print"></i> Imprimir por fecha
           </button>

           @if(session()->has('error'))
           <div class="alert alert-danger">{{ session('error') }}</div>
           @endif
           @elseif($Idatencion && $fecha2)
           <button wire:click="imprimirPorFecha1(3)" class="btn btn-primary ficha-clinica rounded-pill" target="_blank">
               <i class="fas fa-print"></i> Imprimir por fecha
           </button>

           @if(session()->has('error'))
           <div class="alert alert-danger">{{ session('error') }}</div>
           @endif
           @elseif($Idatencion)
           <button wire:click="imprimirPorGeneral(3)" class="btn btn-success ficha-clinica rounded-pill" target="_blank">
               <i class="fas fa-print"></i> IMRRIMIR ESTUDIOS COMPLEMENTARIOS
           </button>
        
           @endif