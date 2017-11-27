<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sutartys;
use App\Kelione;
use DB;

class AtaskaitosController extends Controller
{
    public function popsalys()
    {
        $ataskaita = Sutartys::select(DB::raw('keliones.valstybe as salis'), DB::raw('COUNT(sutartys.nr) as uzsakymu_sk'))
        ->leftJoin('keliones', 'sutartys.keliones_nr', '=', 'keliones.id')
        ->groupBy('salis')
        ->orderBy('uzsakymu_sk', 'desc')
        ->orderBy('salis', 'asc')
        ->get();

        return view('ataskaitos.populiariausiosSalys', compact('ataskaita'));
    }

    public function neapmoketos()
    {
        $ataskaita = Sutartys::leftJoin('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->leftJoin('sutarties_busena', 'sutartys.busena', '=', 'sutarties_busena.id')
        ->leftJoin('users', 'sutartys.vartotojo_id', '=', 'users.id')
        ->where('sutartys.busena', '!=', '3')
        ->where('sutartys.busena', '!=', '5')
        ->whereDate('kelioniu_datos.isvykimo_data', '<', date('Y-m-d'))
        ->orderBy('sutartys.nr')
        ->get();

        return view('ataskaitos.neapmoketosSutartys', compact('ataskaita'));
    }

    public function vidutinesKainos()
    {
        $ataskaita = Kelione::select('valstybe', DB::raw('ROUND(AVG(keliones.kaina), 2) as kaina'))
        ->groupBy('valstybe')
        ->orderBy('valstybe', 'asc')
        ->get();

        return view('ataskaitos.vidutinesKainos', compact('ataskaita'));
    }
}
