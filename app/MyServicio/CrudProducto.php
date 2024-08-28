<?php
namespace App\MyServicio;
class CrudProducto
{
    public $mesaje;
    public function __construct($mesaje)
    {
        //$this->saludar($mesaje);
        $this->mesaje = $mesaje." JANIWA";
    }

    public function devuelve_saludo()
    {
        return($this->mesaje);
    }
    
}
