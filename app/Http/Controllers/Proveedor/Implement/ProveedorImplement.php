<?php
namespace App\Http\Controllers\Proveedor\Implement;

use App\Http\Controllers\Proveedor\Interface\ProveedorInterface;

class ProveedorImplement implements ProveedorInterface
{
    function createProveedor($cedula,$nombre, $apellido, $telefono, $telefono2, $email, $direccion): array
    {
        try {
            return ['succes'=>'Proveedor creado con exito'];
        } catch (\Throwable $th) {
            return ['error'=>'Error inesperado en el servidor error:'.$th];
        }
    }
    function updateProveedor($id_proveedor,$cedula, $nombre, $apellido, $telefono, $telefono2, $email, $direccion): array
    {
        try {
            return ['succes'=>'Proveedor creado con exito'];
        } catch (\Throwable $th) {
            return ['error'=>'Error inesperado en el servidor error:'.$th];
        }
    }
    function deleteProveedor($id_proveedor): array
    {
        try {
            return ['succes'=>'Proveedor actualizado con exito'];
        } catch (\Throwable $th) {
            return ['error'=>'Error inesperado en el servidor error:'.$th];
        }
    }
    function findProveedor($id_proveedor): array
    {
        try {
            return ['succes'=>'Proveedor'];
        } catch (\Throwable $th) {
            return ['error'=>'Error inesperado en el servidor error:'.$th];
        }
    }
    function allProveedor(): array
    {
        try {
            return ['succes'=>'Proveedores'];
        } catch (\Throwable $th) {
            return ['error'=>'Error inesperado en el servidor error:'.$th];
        }
    }
}