<?php

namespace App\Http\Controllers\Vehiculos\Controller;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Vehiculos\Implementacion\VehiculoImplement;
use App\Http\Controllers\Vehiculos\Request\CreateVehiculoRequest;
use App\Http\Controllers\Vehiculos\Request\UpdateVehiculoRequest;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    private $vehiculo;
    /**
     * Inyecto la dependencia de la implementacion
     */
    function __construct(VehiculoImplement  $implement)
    {
        $this->vehiculo = $implement;
    }


    /** creacion de vehiculo
     * @param Request $request post http
     * 
     * @return object
     */
    function createVehiculo(Request $request): object
    {
        $request = CreateVehiculoRequest::Validate($request);
        $estatus = $this->vehiculo->createVehiculo(
            $request['placa'],
            $request['kilometraje'],
            $request['foto1'],
            $request['foto2'],
            $request['foto3'],
            $request['foto4'],
            $request['marcas'],
            $request['modelos'],
            $request['estados'],
            $request['valor'],
            $request['disponibilidad'],
            $request['caja'],
            $request['version'],
            $request['linea'],
            $request['soat'],
            $request['tecnicomecanica']
        );
        // echo $request['tecnicomecanica'];
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }

    function updateVehiculo(Request $request):object
    {
        $request = UpdateVehiculoRequest::validate($request);
        $estatus = $this->vehiculo->updateVehiculo(
            $request['id_vehiculo'],
            $request['placa'],
            $request['kilometraje'],
            $request['marcas'],
            $request['modelos'],
            $request['estados'],
            $request['valor'],
            $request['disponibilidad'],
            $request['caja'],
            $request['version'],
            $request['linea'],
            $request['soat'],
            $request['tecnicomecanica']
        );
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }

    function deleteVehiculo(Request $request):object
    {   
        $id_vehiculo = $request->query('id');
        $estatus = $this->vehiculo->deleteVehiculo($id_vehiculo);
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }

    function allVehiculos(Request $request):object
    {

        $limite = $request->query('limite');
        $offset = $request->query('offset');
        $estatus = $this->vehiculo->allVehiculo($limite,$offset);
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }

    function findVehiculo(Request $request):object
    {
        $id_vehiculo = $request->query('id');
        $estatus = $this->vehiculo->findVehiculo($id_vehiculo);
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }

    function updateImagenVehiculo(Request $request):object
    {   
        $estatus = $this->vehiculo->updateVehiculoImage($request['id_vehiculo'],$request['foto'],$request['key']);
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }

    function agotarVehiculo(Request $request)
    {
        $request = $request->validate(
            [
                'id_vehiculo' => 'required|exists:vehiculos,id'
            ],
            [
                'id_vehiculo.required' => 'El id del vehiculo es obligatorio',
                'id_vehiculo.exists' => 'El vehiculo no existe'
            ]
            );
        $estatus = $this->vehiculo->agotarVehiculo($request['id_vehiculo']);
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }
    public function indexIntercompany()
    {
        $estatus = $this->vehiculo->indexIntercompany();
        return response()->json($estatus,array_key_exists('error',$estatus) ? 500 : 200);
    }
}

