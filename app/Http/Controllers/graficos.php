<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class graficos extends Controller
{
    public function barra()
    {
        $empresa = Auth::user()->empresas;
        $user_id = Auth::user()->id;
        $Query = '
        select 
            count(*) as registros,
            (select count(*) from ventas where MONTH(created_at) = 1    and empresa = '.$empresa.') as enero,
            (select count(*) from ventas where MONTH(created_at) = 2    and empresa = '.$empresa.') as febrero,
            (select count(*) from ventas where MONTH(created_at) = 3    and empresa = '.$empresa.') as marzo,
            (select count(*) from ventas where MONTH(created_at) = 4    and empresa = '.$empresa.') as abril,
            (select count(*) from ventas where MONTH(created_at) = 5    and empresa = '.$empresa.') as mayo,
            (select count(*) from ventas where MONTH(created_at) = 6    and empresa = '.$empresa.') as junio,
            (select count(*) from ventas where MONTH(created_at) = 7    and empresa = '.$empresa.') as julio,
            (select count(*) from ventas where MONTH(created_at) = 8    and empresa = '.$empresa.') as agosto,
            (select count(*) from ventas where MONTH(created_at) = 9    and empresa = '.$empresa.') as septiembre,
            (select count(*) from ventas where MONTH(created_at) = 10   and empresa = '.$empresa.') as optubre,
            (select count(*) from ventas where MONTH(created_at) = 11   and empresa = '.$empresa.') as noviembre,
            (select count(*) from ventas where MONTH(created_at) = 12   and empresa = '.$empresa.') as diciembre
        from ventas where empresa = '.$empresa.'
        ';
        $vista = DB::select($Query);
        return response()->json($vista);
    }
}
