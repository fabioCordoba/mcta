<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cuenta;
use App\Models\Movimiento;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Contadores extends Component
{
    public $total_entradas, $total_salidas, $total_tranfer, $movimientos_mes_Actual, $hoy, $start, $end;
    protected $listeners = [
        'registroGuardado' => 'render'
    ];

    public function render()
    {
        $this->hoy = Carbon::now()->locale('es')->toImmutable();
        $this->start = $this->hoy->startOfMonth(); //primer dia del mes editable
        $this->end = $this->hoy->endOfMonth(); // ultimo dia del mes no editable

        $allMovimientos = Movimiento::where('user_id', Auth::user()->id)
                ->where('estado', 'Activo')
                ->get();

        $this->movimientos_mes_Actual = $allMovimientos->where('created_at', '>=', $this->start)->where('created_at', '<=', $this->end);

        $this->total_tranfer =  $this->movimientos_mes_Actual->where('tipo', 'Transfer')->pluck('monto')->sum();
        $this->total_entradas = $this->movimientos_mes_Actual->where('tipo', 'Entrada')->pluck('monto')->sum() - $this->total_tranfer;
        $this->total_salidas =  $this->movimientos_mes_Actual->where('tipo', 'Salida')->pluck('monto')->sum();

        return view('livewire.contadores',[
            'cuentas' => Cuenta::where('user_id', Auth::user()->id)
                ->where('estado', 'Activo')
                ->get()
        ]);
    }

}
