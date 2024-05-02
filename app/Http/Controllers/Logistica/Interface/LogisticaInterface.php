<?php
namespace App\Http\Controllers\Logistica\Interface;

interface LogisticaInterface{

    function createMovimiento($placa,$actividad,$motivo,$fecha,$valor,$finalizado):array;

    function updateMovimiento($idMovimiento,$placa,$actividad,$motivo,$fecha,$valor,$finalizado):array;

    function deleteMovimiento($idMovimiento):array;

    function findMovimiento($idMovimiento):array;

    function allMovimientos():array;
}