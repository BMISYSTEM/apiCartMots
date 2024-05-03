<?php
namespace App\Http\Controllers\Logistica;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Logistica\Implement\LogisticaImplement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogisticaController extends Controller
{
    private $logistica;
    function __construct(LogisticaImplement $implement)
    {
        $this->logistica = $implement;
    }

    function createMovimiento(Request $request):object
    {
        $empresa = Auth::user()->empresas;
        // validacion 
        $request = $request->validate(
            [
                'placa'=>'required|exists:vehiculos,placa,empresas,'.$empresa,
                'actividad'=>'required|exists:actividads,id,empresas,'.$empresa,
                'motivo'=>'required|exists:motivos,id,empresas,'.$empresa,
                'fecha'=>'required|date|date_format:Y-m-d H:i:s',
                'valor'=>'required',
                'finalizado'=>'required'
            ],
            [
                'placa.required'=>'La placa es obligatoria',
                'placa.exists' => 'La palca ingresada no existe',
                'actividad.required'=>'La actividad es obligatoria',
                'actividad.exists'=>'La actividad no existe',
                'motivo.required'=>'El motivo es obligatoria ',
                'motivo.exists'=>'El motivo no existe  ',
                'fecha.required'=>'La fecha es obligatoria',
                'fecha.date_format'=>'La fecha no tiene el formato esperado',
                'fecha.date'=>'La fecha no es valida',
                'valor.required'=>'El valor es obligatorio',
                'finalizado.required'=>'El estado es obligatorio',
            ]
        );
        // implementacion
        $estatus = $this->logistica->createMovimiento($request['placa'],$request['actividad'],$request['motivo'],$request['fecha'],$request['valor'],$request['finalizado']);
        // $estatus = ['succes'=>true];
        
        // respuesta
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }

    function updateMovimiento(Request $request):object
    {
        $empresa = Auth::user()->empresas;

        $request = $request->validate(
            [
                'id'=>'required|exists:logisticas,id,empresas,'.$empresa,
                'placa'=>'required|exists:vehiculos,placa,empresas,'.$empresa,
                'actividads'=>'required|exists:actividads,id,empresas,'.$empresa,
                'motivos'=>'required|exists:motivos,id,empresas,'.$empresa,
                'fecha'=>'required|date|date_format:Y-m-d H:i:s',
                'Valor'=>'required',
                'finalizado'=>'required'
            ],
            [
                'id.required'=>'el id del movimiento obligatoria',
                'placa.required'=>'La placa es obligatoria',
                'placa.exists' => 'La palca ingresada no existe',
                'actividads.required'=>'La actividad es obligatoria',
                'motivo.required'=>'El motivo es obligatoria ',
                'fecha.required'=>'La fecha es obligatoria',
                'Valor.required'=>'El valor es obligatorio',
                'finalizado.required'=>'El estado es obligatorio',
            ]
        );
        $estatus = $this->logistica->updateMovimiento($request['id'],$request['placa'],$request['actividads'],$request['motivos'],$request['fecha'],$request['Valor'],$request['finalizado']);
        // $estatus = ['succes'=>true];

        // respuesta
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }

    function deleteMovimiento(Request $request):object
    {
        $request = $request->validate(
            [
                'id_movimiento'=>'required',
            ],
            [
                'id_movimiento.required'=>'el id del movimiento obligatoria',
            ]
        );
        $estatus = $this->logistica->deleteMovimiento($request['id_movimiento']);
        // respuesta
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }

    function findMovimiento(Request $request):object
    {
        $request = $request->validate(
            [
                'id_movimiento'=>'required',
            ],
            [
                'id_movimiento.required'=>'el id del movimiento obligatoria',
            ]
        );
        $estatus = $this->logistica->findMovimiento($request['id_movimiento']);
        // respuesta
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }
    function allMovimientos():object
    {
       
        $estatus = $this->logistica->allMovimientos();
        // respuesta
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }
}