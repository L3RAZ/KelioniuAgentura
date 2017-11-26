<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelione;
use App\Kelioniu_datos;
use App\Viesbuciai_keliones;
use DB;
use Session;

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
        $kelione = Kelione::select('keliones.id', DB::raw('miestas.pavadinimas as miesto_pav'), 'valstybe', 'kaina', 
                    'transporto_priemones', 'aprasymas', DB::raw('keliones_tipas.tipas as kel_tipas'))
        ->join('miestas', 'miestas.kodas', '=', 'keliones.miesto_kodas')
        ->join('keliones_tipas', 'keliones_tipas.id', '=', 'keliones.tipas')
        ->where('keliones.id', '=', $id)
        ->first();

        Session::put(['kelione'=>$kelione]);

        $datos = Kelioniu_datos::select('id', 'keliones_nr', 'isvykimo_data', 'grizimo_data', 'laisvu_vietu_sk')
        ->where('keliones_nr', '=', $id)
        ->where('laisvu_vietu_sk', '>', '0')
        ->get();

        
        $viesbuciai = Viesbuciai_keliones::select('viesbucio_id', 
                        DB::raw('viesbuciai.pavadinimas as pavadinimas'), DB::raw('viesbuciai.reitingas as reitingas'),
                        DB::raw('viesbuciai.paros_kaina as paros_kaina'), DB::raw('viesbuciai.adresas as adresas'),
                        DB::raw('viesbuciai.telefono_nr as tel_nr'))
        ->join('viesbuciai', 'viesbuciai.id', '=', 'viesbuciai_keliones.viesbucio_id')
        ->where('keliones_nr', '=', $id)
        ->get();

        return view('keliones.kelione', compact('kelione', 'datos', 'viesbuciai'));//, compact('datos'), compact('viesbuciai'));
    }
}
