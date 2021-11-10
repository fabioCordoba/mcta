<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Cuenta;

class CuentaController extends Controller
{
    public function index()
    {
        return Cuenta::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'user_id' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
        ], [
            'user_id.required' => 'Debes ingresar un user',
            'nombre.required' => 'Debes ingresar un nombre',
            'descripcion.required' => 'Debes ingresar una descripcion',
        ])->validate();

        $cuenta = Cuenta::create([
            'user_id' => $request->user_id,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => 'Activo'
        ]);

        return [
            'success' => true,
            'noti' => 'Registro Creado.',
            'cuenta' => $cuenta
        ];
    }

    public function show($id)
    {
        return Cuenta::find($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'user_id' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
        ], [
            'user_id.required' => 'Debes ingresar un user',
            'nombre.required' => 'Debes ingresar un nombre',
            'descripcion.required' => 'Debes ingresar una descripcion',
        ])->validate();

        $cuenta = Cuenta::find($id);
        $cuenta->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return [
            'success' => true,
            'noti' => 'Registro Actualizado.',
            'cuenta' => $cuenta
        ];
    }

    public function destroy($id)
    {
        $cuenta = Cuenta::find($id);
        $cuenta->update([
            'estado' => 'Eliminado'
        ]);

        return [
            'success' => true,
            'noti' => 'Registro Eliminado.',
            'cuenta' => $cuenta
        ];
    }

    public function search($nombre)
    {
        return Cuenta::where('nombre', 'like', '%'.$nombre.'%')->get();
    }

}
