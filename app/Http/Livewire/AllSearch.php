<?php

namespace App\Http\Livewire;
use App\Models\Movimiento;
use App\Models\Cuenta;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Livewire\Component;

class AllSearch extends Component
{
    public $dataMovimientos;

    public function render()
    {
        $this->dataMovimientos = Movimiento::where('user_id', Auth::user()->id)
                ->where('estado', 'Activo')
                ->orderBy('id', 'DESC')
                ->get();

        return view('livewire.all-search',[
            'movimientos' => $this->dataMovimientos,
            'cuentas' => Cuenta::where('user_id', Auth::user()->id)
                ->where('estado', 'Activo')
                ->get()
        ]);
    }
}
