<?php
namespace App\Http\Controllers\Logistica\Implement;

use App\Http\Controllers\Logistica\Interface\LogisticaInterface;
use App\Models\logistica;
use Illuminate\Support\Facades\Auth;

class LogisticaImplement implements LogisticaInterface
{
    function createMovimiento($placa, $actividad, $motivo, $fecha, $valor, $finalizado): array
    {
        try {
            $logisticas = logistica::create(
                [
                    'placa'=>$placa,
                    'actividads'=>$actividad,
                    'motivos'=>$motivo,
                    'fecha'=>$fecha,
                    'valor'=>$valor,
                    'finalizado'=>$finalizado,
                    'empresas'=>Auth::user()->empresas
                ]
            );
            return ['succes'=>'Se guardo correctamente el movimiento'];
        } catch (\Throwable $th) {
            return ['error'=>'Error inesperado en el servidor error:'.$th];
        }
    }

    function updateMovimiento($idMovimiento, $placa, $actividad, $motivo, $fecha, $valor, $finalizado): array
    {
        try {
            $logisticas = logistica::find($idMovimiento);
            $logisticas->placa = $placa;
            $logisticas->actividads = $actividad;
            $logisticas->motivos = $motivo;
            $logisticas->fecha = $fecha;
            $logisticas->valor = $valor;
            $logisticas->finalizado = $finalizado;
            $logisticas->save();
            return ['succes'=>'Se actualizo correctamente el movimiento'];
        } catch (\Throwable $th) {
            return ['error'=>'Error inesperado en el servidor error:'.$th];
        }
    }

    function deleteMovimiento($idMovimiento): array
    {
        try {
            $logisticas = logistica::find($idMovimiento)->delete();
            return ['succes'=>'Se Elimino correctamente el movimiento'];
        } catch (\Throwable $th) {
            return ['error'=>'Error inesperado en el servidor error:'.$th];
        }
    }

    function findMovimiento($idMovimiento): array
    {
        try {
            $logisticas = logistica::find($idMovimiento);
            return ['succes'=>$logisticas];
        } catch (\Throwable $th) {
            return ['error'=>'Error inesperado en el servidor error:'.$th];
        }
    }
    function allMovimientos(): array
    {
        try {
            $logisticas = logistica::all();
            return ['succes'=>$logisticas];
        } catch (\Throwable $th) {
            return ['error'=>'Error inesperado en el servidor error:'.$th];
        }
    }
}