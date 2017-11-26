<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Draudimai;
use App\Ekskursijos;
use App\Auto_nuomos;
use App\Sutartys;
use App\Sutartys_ekskursijos;
use DB;
use Auth;
use Redirect;

class PaslaugosController extends Controller
{
    public function show($id)
    {
        if(!Auth::check())
            return Redirect::to('/');

        $ekskursijos = Sutartys_ekskursijos::select('sutartys_ekskursijos.sutarties_nr', 'ekskursijos.isvykimo_data',
        'ekskursijos.grizimo_data', 'ekskursijos.vieta', 'ekskursijos.kaina', 'ekskursijos.gidas')
        ->join('ekskursijos', 'sutartys_ekskursijos.ekskursijos_nr', '=', 'ekskursijos.nr')
        ->where('sutartys_ekskursijos.sutarties_nr', '=', $id)
        ->get();

        $auto_nuomos = Auto_nuomos::where('sutarties_nr', '=', $id)
        ->get();

        $sutartis = Sutartys::where('nr', '=', $id)->first();

        if( $sutartis->draudimo_nr != NULL ){
            $draudimas = Sutartys::select(DB::raw('sutartys.nr as sutartis'), 'draudimai.nr', 'draudimai.kaina',
            'draudimai.galioja_nuo', 'draudimai.galioja_iki', 'draudimai.draudimo_imone', 'draudimo_tipas.tipas')
            ->join('draudimai', 'sutartys.draudimo_nr', '=', 'draudimai.nr')
            ->join('draudimo_tipas', 'draudimai.tipas', '=', 'draudimo_tipas.id')
            ->where('sutartys.nr', '=', $id)
            ->first();
        }

        if( $sutartis->viesbucio_id != NULL ){
            $viesbutis = Sutartys::select(DB::raw('sutartys.nr as sutartis'), 'viesbuciai.id', 'viesbuciai.pavadinimas',
            'viesbuciai.reitingas', 'viesbuciai.paros_kaina', DB::raw('miestas.pavadinimas as misto_pav'), 'viesbuciai.adresas',
            'viesbuciai.telefono_nr')
            ->join('viesbuciai', 'sutartys.viesbucio_id', '=', 'viesbuciai.id')
            ->join('miestas', 'viesbuciai.miesto_kodas', '=', 'miestas.kodas')
            ->where('sutartys.nr', '=', $id)
            ->first();
        }

        return view('paslaugos.sutartiesPaslaugos', compact('ekskursijos', 'auto_nuomos', 'viesbutis'));
    }
}
