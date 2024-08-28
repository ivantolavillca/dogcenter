<?php
namespace App\Models\Modulos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class ComprasProductos extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_compra',
        'producto_id',
        'descripcion',
        'cantidad_inicial',
        'precio',
        'estado',
    ];
    //  recibe los ides de sus papas
  
    public function produc_compras(){
        return $this->belongsTo(Productos::class , 'producto_id');
    }
    public function datos_comp(){
        return $this->belongsTo(Compras::class , 'id_compra');
    }
}
