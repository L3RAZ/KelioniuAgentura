<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sutartys;
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
}
