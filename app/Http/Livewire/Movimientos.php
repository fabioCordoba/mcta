<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Movimiento;
use App\Models\Cuenta;
use Illuminate\Support\Facades\Auth;

class Movimientos extends Component
{
    public $cuenta_id, $tipo, $descripcion, $monto, $movimiento, $cuenta_destino_id;
    protected $listeners = ['say-delete' => 'delete'];

    public function render()
    {
        return view('livewire.movimientos',[
            'movimientos' => Movimiento::where('user_id', Auth::user()->id)
                ->where('estado', 'Activo')
                ->orderBy('id', 'DESC')
                ->get(),
            'cuentas' => Cuenta::where('user_id', Auth::user()->id)
                ->where('estado', 'Activo')
                ->get()
        ]);
    }

    public function closeModal($modal){
        $this->dispatchBrowserEvent('closeModal', ['modal' => $modal]);
        $this->resetInputs();
    }

    public function resetInputs(){
        $this->cuenta_id = null;
        $this->tipo = null;
        $this->descripcion = null;
        $this->monto = null;
        $this->movimiento = null; 
        $this->cuenta_destino_id = null;
    }

    public function store(){

        $validatedData = $this->validate([
            'cuenta_id' => 'required',
            'tipo' => 'required',
            'descripcion' => 'required',
            'monto' => 'required',
        ]);

        if($this->movimiento){
            $this->movimiento->update([
                'user_id' => Auth::user()->id,
                'cuenta_id' => $this->cuenta_id,
                'monto' => $this->monto,
                'descripcion' => $this->descripcion,
                'tipo' => $this->tipo,
                'estado' => 'Activo'
            ]);

            if ($this->cuenta_destino_id && $this->movimiento->tipo == 'Transfer') {
                
                // Movimiento Destino
                $movimiento_destino = Movimiento::create([
                    'user_id' => Auth::user()->id,
                    'cuenta_id' => $this->cuenta_destino_id,
                    'monto' => $this->monto,
                    'descripcion' =>'Movimiento desde '. $this->movimiento->cuenta->nombre . ' a ' . Auth::user()->cuentas()->find($this->cuenta_destino_id)->nombre,
                    'tipo' => 'Entrada',
                    'estado' => 'Activo'
                ]);
            }
            $this->dispatchBrowserEvent('msj',['msj' => 'Movimiento Actualizada con exito...', 'tipo' => 'alert-success']);
        }else{
            // Movimiento Origen
            $movimiento = Movimiento::create([
                'user_id' => Auth::user()->id,
                'cuenta_id' => $this->cuenta_id,
                'monto' => $this->monto,
                'descripcion' => $this->descripcion,
                'tipo' => $this->tipo,
                'estado' => 'Activo'
            ]);

            if ($this->cuenta_destino_id && $movimiento->tipo == 'Transfer') {
                
                // Movimiento Destino
                $movimiento_destino = Movimiento::create([
                    'user_id' => Auth::user()->id,
                    'cuenta_id' => $this->cuenta_destino_id,
                    'monto' => $this->monto,
                    'descripcion' =>'Movimiento desde '. $movimiento->cuenta->nombre . ' a ' . Auth::user()->cuentas()->find($this->cuenta_destino_id)->nombre,
                    'tipo' => 'Entrada',
                    'estado' => 'Activo'
                ]);
            }

            $this->dispatchBrowserEvent('msj',['msj' => 'Movimiento agregada con exito...', 'tipo' => 'alert-success']);
        }
        
        
        $this->closeModal('Movimiento');
        $this->emit('registroGuardado');
    }

    public function delMovimiento($id){
        $this->dispatchBrowserEvent('eliminar', ['id' => $id]);
    }

    public function delete($id){
        Movimiento::find($id)->delete();
        $this->dispatchBrowserEvent('Delete');
    }

    public function abrirModal($id, $modal){
        
        $this->movimiento = Movimiento::find($id);
        $this->cuenta_id = $this->movimiento->cuenta_id;
        $this->tipo = $this->movimiento->tipo;
        $this->descripcion = $this->movimiento->descripcion;
        $this->monto = $this->movimiento->monto;
        $this->dispatchBrowserEvent('openModal', ['modal' => $modal]);
    }
}
