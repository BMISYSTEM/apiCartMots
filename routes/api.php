<?php

use App\Http\Controllers\Actividades\ActividadesController;
use App\Http\Controllers\AsesorioController;
use App\Http\Controllers\Asociaciones\Controller\AsociacionesController;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\botController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\Empresas\Controller\EmpresaController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\graficos;
use App\Http\Controllers\ImagenesController;
use App\Http\Controllers\Logistica\LogisticaController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\Motivos\MotivosController;
use App\Http\Controllers\NotasController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PasarelaController;
use App\Http\Controllers\Proveedor\ProveedorController;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\SetpdfController;
use App\Http\Controllers\SolicitudCredito;
use App\Http\Controllers\TransferenciasController;
// use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\Vehiculos\Controller\VehiculoController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function(){
    // usuario
    Route::get('/users', function (Request $request) {
        return $request->user();
    });
    Route::post('/users/updatefoto',[Authcontroller::class,'updateFoto']);
    Route::post('/users/updatenombre',[Authcontroller::class,'updatenombre']);
    Route::post('/users/updateapellido',[Authcontroller::class,'updateapellido']);
    Route::post('/users/updateemail',[Authcontroller::class,'updateemail']);
    Route::post('/users/updatecedula',[Authcontroller::class,'updatecedula']);
    Route::post('/users/updatepassword',[Authcontroller::class,'updatepassword']);
    // dashboard
    Route::get('/dashboard/resumen',[dashboard::class,'index']);
    // notificaciones 
    Route::get('/clientes/notificaciones',[NotificacionController::class,'index']);
    Route::get('/clientes/alertas',[NotificacionController::class,'alertas']);
    
    Route::post('/create',[Authcontroller::class,'create']);
    Route::post('/logout',[Authcontroller::class,'logout']);
    Route::get('/permisos',[Authcontroller::class,'permisos']);
    //marcas 
    Route::post('/marca',[MarcasController::class,'create']);
    Route::get('/index',[MarcasController::class,'index']);
    // update marcas 
    Route::post('/marca/update',[MarcasController::class,'update']);
    //modelos
    Route::post('/modelo',[ModeloController::class,'create']);
    Route::get('/modelo',[ModeloController::class,'index']);
    //estados
    Route::post('/estados',[EstadoController::class,'create']);
    Route::post('/estados/update',[EstadoController::class,'update']);
    Route::get('/estados',[EstadoController::class,'index']);
     /*
    |--------------------------------------------------------------------------
    | clientes
    |--------------------------------------------------------------------------
    |
    | create,index
    |
    */
    Route::post('/clientes',[ClienteController::class,'create']);
    Route::get('/clientes',[ClienteController::class,'index']);
    Route::get('/clientes/infocliente',[ClienteController::class,'infocliente']);
    Route::get('/clientes/pendientes',[ClienteController::class,'pendientes']);
    Route::get('/clientes/aprobados',[ClienteController::class,'aprobados']);
    Route::get('/clientes/vendidos',[ClienteController::class,'vendidos']);
    Route::post('/clientes/documentos',[ClienteController::class,'descargasdoc']);
    Route::post('/clientes/estados',[ClienteController::class,'updateEstados']);
    Route::get('/clientes/seguimiento',[ClienteController::class,'seguimiento']);
    Route::get('/clientes/finalizados',[ClienteController::class,'finalizados']);
    Route::get('/clientes/busqueda',[ClienteController::class,'busqueda']);
    Route::post('/cliente/documento',[ClienteController::class,'documentos']);
    Route::get('/clientes/documentos/index',[ClienteController::class,'documentosall']);
    Route::get('/clientes/documentos/centrofinanciero',[ClienteController::class,'seguimiento_centro']);
    Route::get('/cliente',[ClienteController::class,'cliente']);
    Route::post('clientes/update',[ClienteController::class,'updateCliente']);
    // graficos 
    Route::get('/clientes/ventas/barra',[graficos::class,'barra']);

    //todos los usuarios\
    Route::get('/usuarios',[Authcontroller::class,'index']);
    Route::get('/usuarios/permisos',[Authcontroller::class,'users_permisos']);
    Route::post('/usuarios/update_permisos',[Authcontroller::class,'updatePermisos']);
    Route::post('/usuarios/bloqueo',[Authcontroller::class,'BloqueoUser']);
    Route::post('/usuarios/ativacion',[Authcontroller::class,'ActivaUser']);
    //asesorios
    Route::post('/asesorios',[AsesorioController::class,'create']);
    Route::get('/asesorios',[AsesorioController::class,'index']);
    //seguimiento 
    Route::post('/seguimiento/nota',[NotasController::class,'create']);
    Route::get('/seguimiento/nota',[NotasController::class,'index']);
    //resultados
    Route::post('/resultado',[ResultadoController::class,'create']);
    Route::get('/resultado',[ResultadoController::class,'index']);
    //pdfs cotizacion
    Route::post('/setpedf',[SetpdfController::class,'create']);
    Route::get('/setpedf',[SetpdfController::class,'index']);
    Route::get('/setpedf/asesorio',[SetpdfController::class,'asesorios']);
    Route::post('/pdf/descarga',[SetpdfController::class,'dowload']);
    //pdf solicitud de credito
    Route::post('/solicitud/credito',[SolicitudCredito::class,'create']);
    Route::get('/solicitud/index',[SolicitudCredito::class,'index']);
    //roles
    Route::get('/users/rol',[Authcontroller::class,'user']);
    // intercompany
    Route::post('/intercompany',[TransferenciasController::class,'create']);
    Route::post('/intercompany/asignar',[TransferenciasController::class,'asignar']);
    Route::get('/intercompany/enviados',[TransferenciasController::class,'index']);
    Route::get('/intercompany/recepcion',[TransferenciasController::class,'recepcionenviados']);

    // bot 
    Route::post('/bot/newchat',[botController::class,'createNewBot']);
    Route::post('/bot/updatecampana',[botController::class,'updatecampana']);
    Route::post('/bot/asignacion',[botController::class,'createclientebot']);
    Route::get('/bot/newchat',[botController::class,'index']);
    Route::get('/bot/asesores',[botController::class,'asesores']);
    Route::get('/bot/campana',[botController::class,'listchat']);
    Route::get('/bot/campanas/seguimiento',[botController::class,'campanaseguimiento']);
    Route::get('/bot/campanas/chat',[botController::class,'chatbotone']);
    Route::get('/bot/findcampana',[botController::class,'findcampana']);
    Route::get('/bot/mensajes',[botController::class,'mensajes']);

     /*
    |--------------------------------------------------------------------------
    | Rutas de vehiculos
    |--------------------------------------------------------------------------
    |
    | create, update , delete , find , all, metodos que se consumen con las rutas.
    |
    */
    Route::post('/createvehiculo',[VehiculoController::class,'createVehiculo']);
    Route::post('/updatevehiculo',[VehiculoController::class,'updateVehiculo']);
    Route::get('/deletevehiculo',[VehiculoController::class,'deleteVehiculo']);
    Route::get('/allvehiculo',[VehiculoController::class,'allVehiculos']);
    Route::get('/findvehiculo',[VehiculoController::class,'findVehiculo']);
    Route::get('/indexintercompany',[VehiculoController::class,'indexIntercompany']);
    Route::post('/updateimagen',[VehiculoController::class,'updateImagenVehiculo']);
    Route::post('/agotarvehiculo',[VehiculoController::class,'agotarVehiculo']);
     /*
    |--------------------------------------------------------------------------
    | Tienen que ver con la empresas
    |--------------------------------------------------------------------------
    |
    | index 
    |
    */
    Route::get('/empresas',[EmpresaController::class,'indexEmpresas']);
    /*
    |--------------------------------------------------------------------------
    | asociaciones
    |--------------------------------------------------------------------------
    |
    | create,consulta todas las solicitudes 
    |
    */
    Route::post('/newasociacion',[AsociacionesController::class,'createAsociacion']);
    Route::post('/updatesolicitud',[AsociacionesController::class,'updateSolicitud']);
    Route::get('/indexsolicitudes',[AsociacionesController::class,'indexsolicitudes']);
    Route::get('/indexsolicitudesrecibidas',[AsociacionesController::class,'indexsolicitudesRecibidas']);
    Route::get('/indexasociaciones',[AsociacionesController::class,'indexasociaciones']);
    Route::get('/cancelarenviosolicitud',[AsociacionesController::class,'cancelarEnvioSolicitud']);
    Route::get('/aprobarsolicitud',[AsociacionesController::class,'AprobarSolicitud']);
     /*
    |--------------------------------------------------------------------------
    | Actividades
    |--------------------------------------------------------------------------
    |
    | create,consulta todas las actividades 
    |
    */
    Route::post('/createactividad',[ActividadesController::class,'createActividad']);
    Route::post('/updateactividad',[ActividadesController::class,'updateActividad']);
    Route::post('/deleteactividad',[ActividadesController::class,'deleteActividad']);
    Route::post('/findactividad',[ActividadesController::class,'findActividad']);
    Route::get('/allactividades',[ActividadesController::class,'allActividad']);
     /*
    |--------------------------------------------------------------------------
    | Motivos
    |--------------------------------------------------------------------------
    |
    | create,consulta todas las motivos 
    |
    */
    Route::post('/createmotivos',[MotivosController::class,'createMotivo']);
    Route::post('/updatemotivos',[MotivosController::class,'updateMotivo']);
    Route::post('/deletemotivos',[MotivosController::class,'deleteMotivo']);
    Route::post('/findmotivos',[MotivosController::class,'findMotivo']);
    Route::get('/allmotivos',[MotivosController::class,'allMotivo']);
  /*
    |--------------------------------------------------------------------------
    | Logistica / movimientos
    |--------------------------------------------------------------------------
    |
    | create,consulta todas las movimientos 
    |
    */
    Route::post('/createmovimiento',[LogisticaController::class,'createMovimiento']);
    Route::post('/updatemovimiento',[LogisticaController::class,'updateMovimiento']);
    Route::post('/deletemovimiento',[LogisticaController::class,'deleteMovimiento']);
    Route::post('/findmovimiento',[LogisticaController::class,'findMovimiento']);
    Route::get('/allmovimiento',[LogisticaController::class,'allMovimientos']);
    /*
    |--------------------------------------------------------------------------
    | proveedor 
    |--------------------------------------------------------------------------
    |
    | create,consulta todas las movimientos 
    |
    */
    Route::post('/createproveedor',[ProveedorController::class,'createProveedor']);
    Route::post('/updateproveedor',[ProveedorController::class,'updateProveedor']);
    Route::post('/deleteproveedor',[ProveedorController::class,'deleteProveedor']);
    Route::post('/findproveedor',[ProveedorController::class,'findProveedor']);
    Route::get('/allproveedor',[ProveedorController::class,'allProveedor']);
});





Route::post('/codigo/empresa',[Authcontroller::class,'codigoempresa']);
Route::post('/empresa/registro',[Authcontroller::class,'registroempresa']);
Route::post('/login',[Authcontroller::class,'login']);
Route::get('/force',[Authcontroller::class,'force']);
Route::get('/imagenes',[ImagenesController::class,'store']);
//generar link
Route::get('/link',[ImagenesController::class,'link']);
Route::get('/prueba',[ClienteController::class,'index']);
// conversacion con el bot
Route::get('/bot/chat',[botController::class,'find']);
Route::get('/bot/chat/consulta',[botController::class,'consulta']);
Route::post('/bot/chat/save',[botController::class,'savechat']);
// pasarela de pagos
Route::get('/preferences',[PasarelaController::class,'preferences']);
