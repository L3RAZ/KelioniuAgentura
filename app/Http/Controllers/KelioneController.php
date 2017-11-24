<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelione;
use DB;

class KelioneController extends Controller
{
    public function index()
    {
        $keliones = Kelione::select(DB::raw('keliones.id as id, keliones.valstybe as valstybe, miestas.pavadinimas as miestas, keliones.kaina as kaina'))
        ->leftJoin('miestas', function($join) {
            $join->on('miestas.kodas', '=', 'keliones.miesto_kodas');
            })
        ->paginate(10);
        return view('layouts.index', compact('keliones'));
    }

    public function show($id)
    {
        $kelione = Kelione::select('keliones.id', DB::raw('miestas.pavadinimas as miesto_pav'), 
                                    'valstybe', 'kaina', 'transporto_priemones', 'aprasymas', DB::raw('keliones_tipas.tipas as kel_tipas'))
        ->join('miestas', 'miestas.kodas', '=', 'keliones.miesto_kodas')
        ->join('keliones_tipas', 'keliones_tipas.id', '=', 'keliones.tipas')
        ->where('keliones.id', '=', $id)
        ->first();


        return view('layouts.kelione', compact('kelione'));
    }
}
