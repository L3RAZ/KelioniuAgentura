<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sutartys;
use App\Kelioniu_datos;
use App\Viesbuciai_keliones;
use DB;
use Eloquent;
use Session;
use Auth;

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
            'pasirinkta_data.required' => 'Būtina pasirinkti kelionės datą.',
            'viesbucio_id.required' => 'Būtina pasirinkti viešbutį.',
            'zmoniu_sk.required' => 'Būtina nurodyti asmenų skaičių'
        ]);
        $sutartis = Sutartys::create(request(['yra_arhyvuota', 'vartotojo_id', 'keliones_nr', 'viesbucio_id', 'sudarymo_data', 'pasirinkta_data', 
        'bendra_kaina', 'busena', 'zmoniu_sk']));

        //Session::put(['sutartis', $sutartis]);

        return redirect('/');
    }

    public function showkliento()
    {
        $vartotojo_id = Auth::id();
        $sutartys = Sutartys::where('vartotojo_id', '=', $vartotojo_id)->get();
        foreach($sutartys as $sutartis){
            if($sutartis->bendra_kaina == 0) {
                $dienos = Sutartys::select(DB::raw('datediff(kelioniu_datos.grizimo_data, kelioniu_datos.isvykimo_data) as dienos'))
                ->join('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
                ->where('sutartys.nr', '=', $sutartis->nr)
                ->first();
                $paros_kaina = Sutartys::select(DB::raw('viesbuciai.paros_kaina as paros_kaina'))
                ->join('viesbuciai', 'sutartys.viesbucio_id', '=', 'viesbuciai.id')
                ->where('sutartys.nr', '=', $sutartis->nr)
                ->first();
                $keliones_kaina = Sutartys::select(DB::raw('keliones.kaina as kaina'))
                ->join('keliones', 'sutartys.keliones_nr', '=', 'keliones.id')
                ->where('sutartys.nr', '=', $sutartis->nr)
                ->first();
                $bendra_kaina = $dienos->dienos * $paros_kaina->paros_kaina * ($sutartis->zmoniu_sk / 2) +
                $keliones_kaina->kaina * $sutartis->zmoniu_sk;
                
                Sutartys::where('sutartys.nr', '=', $sutartis->nr)
                ->update(['bendra_kaina' => $bendra_kaina]);

                //$sutartis->save();
            
            }
        }

        $kliento_sutartys = Sutartys::where('vartotojo_id', '=', $vartotojo_id)->get();
        return view('layouts.klientoUzsakymai', compact('kliento_sutartys'));
    }
}
