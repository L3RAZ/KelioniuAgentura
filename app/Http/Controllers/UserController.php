<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $darbuotojai=User::select()->join('');
        Sutartys::select(DB::raw('datediff(kelioniu_datos.grizimo_data, kelioniu_datos.isvykimo_data) as dienos'))
        ->join('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->where('sutartys.nr', '=', $sutartis->nr)
        ->first();
    }

    public function destroy($id)
    {
        //
    }
}
