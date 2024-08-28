<?php

namespace App\Http\Livewire\Modulos;

use App\Models\Admin\siadi_convocatoria;
use App\Models\Admin\siadi_documento;
use App\Models\Admin\siadi_gestion;
use App\Models\Admin\siadi_sede;
use App\Models\Admin\siadi_tipo_convocatoria;
use App\Models\Admin\siadi_tipo_estudiante;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PlanificarConvocatoriaIndex extends Component
{
    
    use WithPagination;

    public $search = '';
    protected $listeners = [
        'render', 'delete',
    ];
protected $paginationTheme = 'bootstrap';

   

    public function updatingSearch(){
        $this->resetPage();
    }

    // public function updated($propertyName){
    //     $this->validateOnly($propertyName);
    
    //   }

    public function render()
    {
        $gestiones=siadi_gestion::where('estado_siadi_gestion','ACTIVO')->get();
        $tipo_estudiantes=siadi_tipo_estudiante::where('estado_siadi_tipo_estudiante','ACTIVO')->get();
$listar_tipo_convocatorias2=siadi_tipo_convocatoria::where('id_siadi_tipo_estudiante',$this->tipo_estudiante2)
->where('estado_siadi_tipo_convocatoria' ,'ACTIVO')
->get();
$listar_tipo_convocatorias=siadi_tipo_convocatoria::where('id_siadi_tipo_estudiante',$this->tipo_estudiante)
->where('estado_siadi_tipo_convocatoria' ,'ACTIVO')
->get();
$siadi_sedes=siadi_sede::where('estado_siadi_sede','ACTIVO')->get();
$listaDeposito2=siadi_tipo_convocatoria::where('id_siadi_tipo_convocatoria',$this->convocatoria2)
->where('estado_siadi_tipo_convocatoria' ,'ACTIVO')
->first();
$listaDeposito=siadi_tipo_convocatoria::where('id_siadi_tipo_convocatoria',$this->convocatoria)
->where('estado_siadi_tipo_convocatoria' ,'ACTIVO')
->first();
$siadi_documentos=siadi_documento::where('estado_siadi_documento','ACTIVO')->get();
    $planificarconvocatorias = siadi_convocatoria::where('estado_siadi_convocatoria', '<>', 'ELIMINAR')
    ->when($this->search, function ($query) {
        $query->where('tipo_convocatoria_sede_id_id_gestion_periodo', 'LIKE', '%' . $this->search . '%')
            ->orWhereHas('gestion', function ($query) {
                $query->where('anio_siadi_gestion', 'LIKE', '%' . $this->search . '%');
            })
            ->orWhereHas('siadi_tipo_convocatoria', function ($query) {
                $query->whereHas('siadi_tipo_estudiante', function ($query) {
                    $query->where('tipo_siadi_tipo_estudiante', 'LIKE', '%' . $this->search . '%');
                });
            })
            ->orWhereHas('siadi_tipo_convocatoria', function ($query) {
                $query->whereHas('siadi_convocatoria_estudiante', function ($query) {
                    $query->where('convocatoria_siadi_convocatoria_estudiante', 'LIKE', '%' . $this->search . '%');
                });
            })
            ->orWhereHas('siadi_sedes', function ($query) {
                $query->whereHas('sede_nombre', function ($query) {
                    $query->where('nombre', 'LIKE', '%' . $this->search . '%');
                });
            })
            ->orWhereHas('siadi_sedes', function ($query) {
                $query->whereHas('sede_nombre', function ($query) {
                    $query->where('direccion', 'LIKE', '%' . $this->search . '%');
                });
            })
         


            ->orWhere('periodo_siadi_convocatoria', 'LIKE', '%'. $this->search . '%')

            
            ;
    })
    ->latest('id_siadi_convocatoria')
    ->paginate(5);

  

        return view('livewire.modulos.planificar-convocatoria-index',
        compact('planificarconvocatorias','gestiones','tipo_estudiantes','listar_tipo_convocatorias2','listar_tipo_convocatorias','listaDeposito','listaDeposito2','siadi_documentos','siadi_sedes')
    );
    }


    public function delete(siadi_convocatoria $id_siadi_convocatoria): void
    {
        $id_siadi_convocatoria->estado_siadi_convocatoria = 'ELIMINAR';
        $id_siadi_convocatoria->update();

    
          
           
    }

    //CREAR CONVOCATORIA
    public $tipo_estudiante;
    public $convocatoria;
    public $documento;
    public $sede;
 
    public $observacion;
    public $descripcion;
    public $gestion;
    public $periodo;
   
    public $fecha_inicio;
    public $fecha_final;
    protected function rules()
    {
        $year = Carbon::now()->year;

        return [
            'observacion' => 'required',
        'descripcion' => 'required',
        'gestion' => 'required|not_in:Elegir...',
        'tipo_estudiante' => 'required|not_in:Elegir...',
        'periodo' => 'required|not_in:Elegir...',
        'convocatoria' => 'required|not_in:Elegir...',
        'documento' => 'required|not_in:Elegir...',
        'sede' => 'required|not_in:Elegir...',
            'fecha_inicio' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($year) {
                    $yearInput = Carbon::parse($value)->year;

                    if ($yearInput != $year) {
                        $fail('La fecha de inicio debe ser del año actual.');
                    }
                },
            ],
            'fecha_final' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($year) {
                    $yearInput = Carbon::parse($value)->year;

                    if ($yearInput != $year) {
                        $fail('La fecha final debe ser del año actual.');
                    }
                },
            ],
        ];
    }


public function updated($propertyName){
    $this->validateOnly($propertyName);

  }


  public function guardar()
      {        
        $this->validate();
       
        $convocatoria = new siadi_convocatoria();
        $convocatoria->tipo_convocatoria_sede_id_id_gestion_periodo         = $this->convocatoria.$this->sede.$this->gestion.$this->periodo;
        $convocatoria->id_siadi_gestion          = $this->gestion;
        $convocatoria->periodo_siadi_convocatoria  = $this->periodo;
        $convocatoria->id_siadi_tipo_convocatoria            = $this->convocatoria;
        $convocatoria->sede_id            = $this->sede;
        $convocatoria->id_siadi_documento             = $this->documento;
        $convocatoria->texto_descripcion_siadi_convocatoria             = $this->descripcion;
        $convocatoria->texto_observacion_siadi_convocatoria             = $this->observacion;
        $convocatoria->fecha_inicio_siadi_convocatoria             = $this->fecha_inicio;
        $convocatoria->fecha_fin_siadi_convocatoria             = $this->fecha_final;
        $convocatoria->fecha_siadi_convocatoria             = date('Y-m-d H:i:s');
        $convocatoria->id_usuario             = Auth::user()->id ;
        $convocatoria->estado_siadi_convocatoria             = 'ACTIVO';
      
       
    
       
        
    
      
        $convocatoria->save();
        
      
    
        
        $this->reset([
    'gestion','periodo','convocatoria','sede','documento','descripcion','observacion','fecha_inicio','fecha_final'
        ]);
    
    
    
        
        $this->emit('closeModalCreate');
            
            $this->emit('alert','El usuario se guardo satisfactoriamente');




         
      }



    //EDITAR CONVOCATORIA
    public $tipo_estudiante2;
    public $convocatoria2;
    public $documento2;
    public $sede2;
 
    public $observacion2;
    public $descripcion2;
    public $gestion2;
    public $periodo2;
   
    public $fecha_inicio2;
    public $fecha_final2;
    public $id_convocatoria_actual;

    public function editar_usuario(siadi_convocatoria $id_convocatoria){

$this->id_convocatoria_actual =$id_convocatoria->id_siadi_convocatoria;
$this->tipo_estudiante2 =$id_convocatoria->siadi_tipo_convocatoria->siadi_tipo_estudiante->id_siadi_tipo_estudiante;
$this->convocatoria2 =$id_convocatoria->id_siadi_tipo_convocatoria;
$this->documento2 =$id_convocatoria->id_siadi_documento;
$this->sede2 =$id_convocatoria->sede_id;
$this->observacion2 =$id_convocatoria->texto_observacion_siadi_convocatoria;
$this->descripcion2 =$id_convocatoria->texto_descripcion_siadi_convocatoria;
$this->gestion2 =$id_convocatoria->id_siadi_gestion;
$this->periodo2 =$id_convocatoria->periodo_siadi_convocatoria;
$this->fecha_inicio2 =$id_convocatoria->fecha_inicio_siadi_convocatoria;
$this->fecha_final2 =$id_convocatoria->fecha_fin_siadi_convocatoria;


    }
    public function cancelarEditar() {
        $this->reset([
            'tipo_estudiante2',
            'convocatoria2',
            'documento2',
            'sede2',
         
            'observacion2',
            'descripcion2',
           'gestion2',
            'periodo2',
           
            'fecha_inicio2',
            'fecha_final2',
            
                ]);
    
    }  
    public function guardarEditadoConvocatoria(){
        $year = Carbon::now()->year;
        $this->validate([
            'observacion2' => 'required',
            'descripcion2' => 'required',
            'gestion2' => 'required|not_in:Elegir...',
            'tipo_estudiante2' => 'required|not_in:Elegir...',
            'periodo2' => 'required|not_in:Elegir...',
            'convocatoria2' => 'required|not_in:Elegir...',
            'documento2' => 'required|not_in:Elegir...',
            'sede2' => 'required|not_in:Elegir...',
                'fecha_inicio2' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) use ($year) {
                        $yearInput = Carbon::parse($value)->year;
    
                        if ($yearInput != $year) {
                            $fail('La fecha de inicio debe ser del año actual.');
                        }
                    },
                ],
                'fecha_final2' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) use ($year) {
                        $yearInput = Carbon::parse($value)->year;
    
                        if ($yearInput != $year) {
                            $fail('La fecha final debe ser del año actual.');
                        }
                    },
                ],
            ]
        );
    
        $siadi_conv = siadi_convocatoria::find($this->id_convocatoria_actual);
    
        $siadi_conv->fill([
            'tipo_convocatoria_sede_id_id_gestion_periodo'         => $this->convocatoria2.$this->sede2.$this->gestion2.$this->periodo2,
            'id_siadi_gestion'          => $this->gestion2,
            'periodo_siadi_convocatoria'  => $this->periodo2,
            'id_siadi_tipo_convocatoria'            => $this->convocatoria2,
           'sede_id'            => $this->sede2,
            'id_siadi_documento'             => $this->documento2,
            'texto_descripcion_siadi_convocatoria'             => $this->descripcion2,
            'texto_observacion_siadi_convocatoria'             => $this->observacion2,
            'fecha_inicio_siadi_convocatoria'             => $this->fecha_inicio2,
            'fecha_fin_siadi_convocatoria'             => $this->fecha_final2,
            'fecha_siadi_convocatoria'             => date('Y-m-d H:i:s'),
            'id_usuario'             => Auth::user()->id,
            
        ]);
        $siadi_conv->save();
    
        $this->reset([
            'tipo_estudiante2',
            'convocatoria2',
            'documento2',
            'sede2',
         
            'observacion2',
            'descripcion2',
           'gestion2',
            'periodo2',
           
            'fecha_inicio2',
            'fecha_final2',
            
                ]);
    
    
     
                
         $this->emit('closeModalEdit');
        
        $this->emit('alert', 'Se editó satisfactoriamente');
    
    }


}

