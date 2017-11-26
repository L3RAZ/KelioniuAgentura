<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Draudimai;
use App\Ekskursijos;
use App\Auto_nuomos;
use App\Sutartys;
use App\Sutartys_ekskursijos;
use App\Viesbuciai_keliones;
use DB;
use Auth;
use Redirect;
use Session;
use Illuminate\Support\Facades\Input;

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
        Session::put(['sutartis'=>$sutartis]);
        return view('paslaugos.sutartiesPaslaugos', compact('ekskursijos', 'auto_nuomos', 'viesbutis', 'draudimas'));
    }

    public function createViesbutis() 
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

    public function storeViesbutis() 
    {
        $viesbutis = Input::get('viesbucio_id');
        $sutarties_nr = Session::get('sutartis')->nr;

        Sutartys::where('sutartys.nr', '=', $sutarties_nr)
        ->update(['viesbucio_id' => $viesbutis]);
        return redirect('/klientouzsakymai/'.$sutarties_nr);
    }

    public function createDraudimas() 
    {
        $sutarties_nr = Session::get('sutartis')->nr;

        $isvykimas = Sutartys::select(DB::raw('kelioniu_datos.isvykimo_data as isvykimas'))
        ->join('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->where('sutartys.nr', '=', $sutarties_nr)
        ->first();

        $grizimas = Sutartys::select(DB::raw('kelioniu_datos.grizimo_data as grizimas'))
        ->join('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->where('sutartys.nr', '=', $sutarties_nr)
        ->first();

        $draudimai = Draudimai::select('nr', 'kaina', 'galioja_nuo', 'galioja_iki', 'draudimo_imone', 'draudimo_tipas.tipas as tipas')
        ->join('draudimo_tipas', 'draudimai.tipas', '=', 'draudimo_tipas.id')
        ->where('galioja_nuo', '<=', $isvykimas->isvykimas)
        ->where('galioja_iki', '>=', $grizimas->grizimas)
        ->get();

        return view('draudimai.uzsakyti', compact('draudimai'));
    }

    public function storeDraudimas() 
    {
        $draudimas = Input::get('draudimo_nr');
        $sutarties_nr = Session::get('sutartis')->nr;

        Sutartys::where('sutartys.nr', '=', $sutarties_nr)
        ->update(['draudimo_nr' => $draudimas]);
        return redirect('/klientouzsakymai/'.$sutarties_nr);
    }

    public function createEkskursija() 
    {
        $sutarties_nr = Session::get('sutartis')->nr;

        $sutarties_info = Sutartys::select(DB::raw('kelioniu_datos.isvykimo_data as isvykimas'), DB::raw('kelioniu_datos.grizimo_data as grizimas'),
        'sutartys.keliones_nr')
        ->join('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->where('sutartys.nr', '=', $sutarties_nr)
        ->first();

        $ekskursijos = Ekskursijos::where('ekskursijos.keliones_nr', '=', $sutarties_info->keliones_nr)
        ->where('isvykimo_data','>=', $sutarties_info->isvykimas)
        ->where('isvykimo_data', '<=', $sutarties_info->grizimas)
        ->where('grizimo_data','>=', $sutarties_info->isvykimas)
        ->where('grizimo_data', '<=', $sutarties_info->grizimas)
        ->get();

        return view('ekskursijos.uzsakyti', compact('ekskursijos', 'sutarties_info'));
    }

    public function storeEkskursija() 
    {
        $ekskursijos = Input::get('ekskursijos_nr');
        $sutarties_nr = Session::get('sutartis')->nr;

        foreach($ekskursijos as $ekskursija) {
            Sutartys_ekskursijos::create(['sutarties_nr' => $sutarties_nr,
                                            'ekskursijos_nr' => $ekskursija]);
        }


        return redirect('/klientouzsakymai/'.$sutarties_nr);
    }
}
