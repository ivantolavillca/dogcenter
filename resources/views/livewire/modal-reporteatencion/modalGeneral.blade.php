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
           <a href="{{ route('imprimircosotosgeneral', ['f1' => $fecha2 ?? 0, 'f2' => $fecha2 ?? 0, 'id_u' => $Idatencion]) }}" class="btn btn-success ficha-clinica rounded-pill" target="_blank">
               <i class="fas fa-print"></i> IMRRIMIR REPORTE GENERAL
           </a>
           @endif