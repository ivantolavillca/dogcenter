<?php

namespace App\PDF;

use Codedge\Fpdf\Fpdf\Fpdf;

class VentaPDF extends FPDF
{
    // Variable para almacenar el número de registro
    private $id;
    private $registro;
    protected $data;
    protected $es;
    public function __construct($numero_registro, $registro, $data,$es)
    {
       // parent::__construct(); // Llama al constructor de la clase padre (Fthis)
        parent::__construct('P', 'mm', 'Letter', true, 'UTF-8', false);
        $this->AddPage();
        $this->id = $numero_registro;
        $this->registro = $registro;
        $this->data = $data;
        $this->es = $es;
    
    }
    // Método para generar el encabezado
    public function Header()
    {
        
        $this->SetTopMargin(15);
        $this->SetLeftMargin(10);
        $this->SetAutoPageBreak(1, 20);
        $this->AliasNbPages();
        // $this->Addpage('P', array(216, 330));
        $this->AddFont('EdwardianScriptITC', '', "EdwardianScriptITC.php");
        $this->Image(public_path("") . '/logo_nuevo.png', 15, 2, 45, 45);
        $this->SetTextColor(0, 80, 0);
        $this->SetFont('EdwardianScriptITC', '', 38);
        $this->Cell(150, 18, utf8_decode('DOG CENTER'), 0, 10, 'R');
    }

    // Método para generar el reporte
    public function generarReporte($registro)
    {
            $this->SetFont('Arial', '', 8);
            $this->SetXY(20, 30);
            if($this->es==1)
            {$this->Cell(45, 25, 'PROVEEDOR:', 0, 0, 'L');}
            else
            {$this->Cell(45, 25, 'CLIENTE:', 0, 0, 'L');}
            
            $this->SetFont('Arial', '', 8);
            $this->SetXY(32, 30);

            if($this->es==1)
            {
                if($this->registro->proveedor_id)
                {
                    $this->Cell(60, 25, utf8_decode($this->registro->preedo_compras->nombre), 0, 0, 'R');
                }else
                {
                    $this->Cell(60, 25, utf8_decode($this->registro->descripcion), 0, 0, 'R');
                }
            }
            else
            {
                if($this->registro->cliente_id)
                {
                    $this->Cell(60, 25, utf8_decode($this->registro->mascota_ventas->mascot_clie->nombre." ".$registro->mascota_ventas->mascot_clie->apellidos), 0, 0, 'R');
                }else
                {
                    $this->Cell(60, 25, utf8_decode($this->registro->descripcion), 0, 0, 'R');
                }
            }

          

            $this->SetFont('Arial', 'B', 8);
            $this->Cell(8, 30, '...............................................................................', 0, 0, 'R');
      

        $this->SetFont('Arial', '', 8);
        $this->SetXY(140, 30);
        $this->Cell(45, 25, 'FECHA:', 0, 0, 'L');
        $this->SetFont('Arial', '', 8);
        $this->SetXY(124, 30);
        $this->Cell(60, 25, $this->registro->created_at, 0, 0, 'R');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(1, 30, '...................................', 0, 0, 'R');


        $this->SetFont('Arial', '', 8);
        $this->SetXY(20, 30);
        $this->Cell(45, 50, 'DESCRIPCION:', 0, 0, 'L');
        $this->SetFont('Arial', '', 8);
        $this->SetXY(42, 30);
        $this->Cell(45, 48, utf8_decode('Venta de productos de farmacia'), 0, 0, 'R');

       
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(50, 50, '...................................................................................................................... ', 0, 0, 'R');

        $this->SetFillColor(0,22,53); // Establecer color de fondo azul petróleo
        $this->SetTextColor(0, 255, 0); // Establecer color de texto verde fosforescente
        $this->SetFont('Arial', '', 10);
        $this->SetXY(75, 60);
        if($this->es==1)
        {$this->Cell(65, 7, utf8_decode('COMPRA Nº: '.$this->id), 1, 0, 'C', true);}
        else{$this->Cell(65, 7, utf8_decode('VENTA Nº: '.$this->id), 1, 0, 'C', true);}
        $this->SetTextColor(0, 0, 0); // Restablecer color de texto a negro
        $this->Ln(15);
        //------------------------------------ reporte de ventas o compras ----------------
        $costo1 = 0;$costo2 = 0;

        if($this->es==2)
        {
        if ($this->data) {
        if (count($this->data) != 0) {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, 'Reporte de ventas', 0, 1, 'C');

            $this->SetFillColor(0, 22, 53);
            $this->SetTextColor(0, 255, 0);
            // Encabezados de las columnas
            $this->SetFont('Arial', 'B', 10);
            $this->Cell(10, 12, 'N', 1, 0, 'C', true);
            $this->Cell(70, 12, 'Nombre del producto', 1, 0, 'L', true);
            $this->Cell(40, 12, 'Cantidad', 1, 0, 'C', true);
            $this->Cell(40, 12, 'Precio de Venta', 1, 0, 'C', true);
            $this->Cell(33, 12, 'Sub total', 1, 1, 'C', true);
            $this->SetFillColor(255, 255, 255);
            $this->SetTextColor(0);
            $i = 1;
            foreach ($this->data as $elem) {
                $this->SetFont('Arial', '', 10);
                $this->Cell(10, 12, $i++, 1, 0, 'C');
                $this->Cell(70, 12, utf8_decode($elem->produc_ventas->nombre), 1, 0, 'C');
                $this->Cell(40, 12, $elem->cantidad, 1, 0, 'C');
                $this->Cell(40, 12, $elem->precio, 1, 0, 'C');
                $this->Cell(33, 12, $elem->cantidad*$elem->precio, 1, 1, 'C');
                $costo1 += $elem->cantidad*$elem->precio;
            }
            $this->Ln(3);
            $this->Cell(130, 10, '', 0, 0); // Espacio en blanco para alinear con la cuarta columna
            $this->Cell(30, 10, 'TOTAL', 1, 0, 'C');
            $this->Cell(33, 10, $costo1 . " Bs", 1, 1, 'C'); // Agregar '1' al final para comenzar en una nueva fila
            $this->Ln(15);
        } }
    }else
    {
        if ($this->data) {
            if (count($this->data) != 0) {
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(0, 10, 'Reporte de compras', 0, 1, 'C');
    
                $this->SetFillColor(0, 22, 53);
                $this->SetTextColor(0, 255, 0);
                // Encabezados de las columnas
                $this->SetFont('Arial', 'B', 10);
                $this->Cell(10, 12, 'N', 1, 0, 'C', true);
                $this->Cell(70, 12, 'Nombre del producto', 1, 0, 'L', true);
                $this->Cell(40, 12, 'Cantidad', 1, 0, 'C', true);
                $this->Cell(40, 12, 'Precio de Compra', 1, 0, 'C', true);
                $this->Cell(33, 12, 'Sub total', 1, 1, 'C', true);
                $this->SetFillColor(255, 255, 255);
                $this->SetTextColor(0);
                $i = 1;
                foreach ($this->data as $elem) {
                    $this->SetFont('Arial', '', 10);
                    $this->Cell(10, 12, $i++, 1, 0, 'C');
                    $this->Cell(70, 12, utf8_decode($elem->produc_compras->nombre), 1, 0, 'C');
                    $this->Cell(40, 12, $elem->cantidad_inicial, 1, 0, 'C');
                    $this->Cell(40, 12, $elem->precio, 1, 0, 'C');
                    $this->Cell(33, 12, $elem->cantidad_inicial*$elem->precio, 1, 1, 'C');
                    $costo2 += $elem->cantidad_inicial*$elem->precio;
                }
                $this->Ln(3);
                $this->Cell(130, 10, '', 0, 0); // Espacio en blanco para alinear con la cuarta columna
                $this->Cell(30, 10, 'TOTAL', 1, 0, 'C');
                $this->Cell(33, 10, $costo2 . " Bs", 1, 1, 'C'); // Agregar '1' al final para comenzar en una nueva fila
                $this->Ln(15);
            } }
    }



        $this->Ln(15);
        $this->Cell(50, 12, '', 0, 0); // Espacio en blanco para alinear con la cuarta columna
        $this->Cell(60, 12, 'TOTAL A PAGAR', 1, 0, 'C');
        if($this->es==2)
        {
            $this->Cell(45, 12, ($costo1) . " Bs", 1, 1, 'C'); 
        }else
        {
            $this->Cell(45, 12, ($costo2) . " Bs", 1, 1, 'C');
        }
       // Agregar '1' al final para comenzar en una nueva fila
        $this->Ln(15);

        $this->SetTextColor(0, 0, 0); // Restablecer color de texto a negro
        $thisgenerado = $this->Output();
        exit;
    }
    public function Footer()
    {
        // Establecer la posición del pie de página a 15 mm del borde inferior
        $this->SetY(-15);
        // Escribir el contenido del pie de página centrado horizontalmente
        $this->Cell(0, 10, utf8_decode(('Pág. ')) . $this->PageNo() . ' de {nb}', 0, 0, 'C');
    }
}
