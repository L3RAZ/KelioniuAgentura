<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sutartys;
use App\Kelioniu_datos;
use App\Viesbuciai_keliones;
use DB;
use Eloquent;
use Session;

class SutartysController extends Controller
{
    public function index()
    {
        return view('layouts.pridetiUzsakyma');
    }

    public function create()
    {
        $keliones_nr = Session::get('kelione')->id;
        $datos = Kelioniu_datos::where('keliones_nr', '=', $keliones_nr)
        ->where('laisvu_vietu_sk', '>', '1')
        ->get();

        $viesbuciai = Viesbuciai_keliones::select('viesbucio_id', 
                        DB::raw('viesbuciai.pavadinimas as pavadinimas'), DB::raw('viesbuciai.reitingas as reitingas'))
        ->join('viesbuciai', 'viesbuciai.id', '=', 'viesbuciai_keliones.viesbucio_id')
        ->where('keliones_nr', '=', $keliones_nr)
        ->get();

        return view('layouts.pridetiUzsakyma', compact('datos', 'viesbuciai'));
    }

    public function store() {
        Eloquent::unguard();

        $this->validate(request(), [
            'pasirinkta_data' => 'required',
            'vartotojo_id' => 'required',
            'keliones_nr' => 'required',
            'viesbucio_id' => 'required',
            'sudarymo_data' => 'required',
            'yra_archyvuota' => 'required',
            'zmoniu_sk' => 'required'
        ],
        [
            'keliones_nr.required' => 'nera keliones'
        ]);
        Sutartys::create(request(['yra_arhyvuota', 'vartotojo_id', 'keliones_nr', 'viesbucio_id', 'sudarymo_data', 'pasirinkta_data', 
        'bendra_kaina', 'busena', 'zmoniu_sk']));

        return redirect('/');
    }
}
