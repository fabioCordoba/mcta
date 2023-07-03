<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cuenta;
use App\Models\Movimiento;
use Illuminate\Support\Facades\Auth;

class Contadores extends Component
{
    public $total_entradas, $total_salidas, $total_tranfer, $movimientos;
    protected $listeners = [
        'registroGuardado' => 'render'
    ];

    public function render()
    {
        $this->movimientos = Movimiento::where('user_id', Auth::user()->id)
                ->where('estado', 'Activo')
                ->get();
        
        $this->total_tranfer =  $this->movimientos->where('tipo', 'Transfer')->pluck('monto')->sum();
        $this->total_entradas = $this->movimientos->where('tipo', 'Entrada')->pluck('monto')->sum() - $this->total_tranfer;
        $this->total_salidas =  $this->movimientos->where('tipo', 'Salida')->pluck('monto')->sum();

        return view('livewire.contadores',[
            'cuentas' => Cuenta::where('user_id', Auth::user()->id)
                ->where('estado', 'Activo')
                ->get()
        ]);
    }

}
