<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Movimiento;

class MovimientoController extends Controller
{
    public function index()
    {
        return Movimiento::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'user_id' => 'required',
            'cuenta_id' => 'required',
            'monto' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required'
        ], [
            'user_id.required' => 'Debes ingresar un user',
            'cuenta_id.required' => 'Debes ingresar una cuenta',
            'nombre.required' => 'Debes ingresar un nombre',
            'descripcion.required' => 'Debes ingresar una descripcion',
            'tipo.required' => 'tipo requerido',
        ])->validate();

        $movimiento = Movimiento::create([
            'user_id' => $request->user_id,
            'cuenta_id' => $request->cuenta_id,
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'estado' => 'Activo'
        ]);

        return [
            'success' => true,
            'noti' => 'Registro Creado.',
            'Movimiento' => $movimiento
        ];
    }

    public function show($id)
    {
        return Movimiento::find($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'user_id' => 'required',
            'cuenta_id' => 'required',
            'monto' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required'
        ], [
            'user_id.required' => 'Debes ingresar un user',
            'cuenta_id.required' => 'Debes ingresar una cuenta',
            'nombre.required' => 'Debes ingresar un nombre',
            'descripcion.required' => 'Debes ingresar una descripcion',
            'tipo.required' => 'tipo requerido',
        ])->validate();

        $movimiento = Movimiento::find($id);
        $movimiento->update([
            'cuenta_id' => $request->cuenta_id,
            'monto' => $request->monto,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            
        ]);

        return [
            'success' => true,
            'noti' => 'Registro Actualizado.',
            'Movimiento' => $movimiento
        ];
    }

    public function destroy($id)
    {
        $movimiento = Movimiento::find($id);
        $movimiento->update([
            'estado' => 'Eliminado'
        ]);

        return [
            'success' => true,
            'noti' => 'Registro Eliminado.',
            'Movimiento' => $movimiento
        ];
    }

    public function search($descripcion)
    {
        return Movimiento::where('descripcion', 'like', '%'.$descripcion.'%')->get();
    }
}
