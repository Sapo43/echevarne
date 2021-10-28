<?php

namespace App\Exports;

use App\Models\Producto;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Events\BeforeSheet;

class ProductExport implements FromCollection,WithHeadings,ShouldAutoSize{

    protected $nombre;
    protected $rubro;
    protected $marca;
    protected $codigo;
    function __construct($nombre, $rubro,$marca,$codigo) {
        $this->nombre = $nombre;
        $this->rubro = $rubro;
        $this->marca = $marca;
        $this->codigo = $codigo;
 }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
  
        $productos=Producto::filterForExcel($this->nombre,$this->rubro,$this->marca,$this->codigo, "1");
      
        return $productos;
    }


    public function headings(): array
    {
        return [
            'Código', 'Producto', 'Rubro', 'Marca','Precio Lista', 'Precio Compra', 'Precio Venta'
        ];
    }
}

