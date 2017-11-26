<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Viesbuciai_keliones;
use App\Sutartys;
use DB;
use Session;
use Illuminate\Support\Facades\Input;

class ViesbutisController extends Controller
{
    public function create() 
    {
        $sutarties_nr = Session::get('sutartis')->nr;

        $kelione = Sutartys::select('keliones_nr')
        ->where('sutartys.nr', '=', $sutarties_nr)
        ->first();

        $keliones_nr = $kelione->keliones_nr;

        $viesbuciai = Viesbuciai_keliones::select('viesbucio_id', 
        DB::raw('viesbuciai.pavadinimas as pavadinimas'), DB::raw('viesbuciai.reitingas as reitingas'),
        DB::raw('viesbuciai.paros_kaina as paros_kaina'), DB::raw('viesbuciai.adresas as adresas'),
        DB::raw('viesbuciai.telefono_nr as tel_nr'))
        ->join('viesbuciai', 'viesbuciai.id', '=', 'viesbuciai_keliones.viesbucio_id')
        ->where('keliones_nr', '=', $keliones_nr)
        ->get();

        return view('viesbuciai.uzsakyti', compact('viesbuciai', 'sutarties_nr', 'keliones_nr'));
    }

    public function store() 
    {
        $viesbutis = Input::get('viesbucio_id');
        $sutarties_nr = Session::get('sutartis')->nr;

        Sutartys::where('sutartys.nr', '=', $sutarties_nr)
        ->update(['viesbucio_id' => $viesbutis]);
        return redirect('/klientouzsakymai');
    }
}
