<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cuenta as Cta;
use Illuminate\Support\Facades\Auth;

class Cuenta extends Component
{

    public $nombre, $descripcion, $cuenta;
    protected $listeners = ['say-delete' => 'delete'];
 
    public function store(){
        $validatedData = $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        if($this->cuenta){
            $this->cuenta->update([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'estado' => 'Activo'
            ]);
            $this->dispatchBrowserEvent('msj',['msj' => 'Cuenta Actualizada con exito...', 'tipo' => 'alert-success']);
        }else{
            $cuenta = Cta::create([
                'user_id' => Auth::user()->id,
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'estado' => 'Activo'
            ]);
            $this->dispatchBrowserEvent('msj',['msj' => 'Cuenta agregada con exito...', 'tipo' => 'alert-success']);
        }
        

        $this->closeModal('Cuenta');
    }

    public function delCta($id){
        $this->dispatchBrowserEvent('eliminar', ['id' => $id]);
    }

    public function delete($id){
        Cta::find($id)->update([
            'estado' => 'Eliminado'
        ]);
        $this->dispatchBrowserEvent('Delete');
    }

    public function abrirModal($id, $modal){
        
        $this->cuenta = Cta::find($id);
        $this->nombre = $this->cuenta->nombre;
        $this->descripcion = $this->cuenta->descripcion;
        $this->dispatchBrowserEvent('openModal', ['modal' => $modal]);
    }

    public function closeModal($modal){
        $this->dispatchBrowserEvent('closeModal', ['modal' => $modal]);
        $this->resetInputs();
    }

    public function resetInputs(){
        $this->nombre = null;
        $this->descripcion = null;
        $this->cuenta = null;
    }

    public function render()
    {
        return view('livewire.cuenta',[
            'cuentas' => Cta::where('user_id', Auth::user()->id)
                ->where('estado', 'Activo')
                ->get(),
        ]);
    }
}
