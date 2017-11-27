<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Draudimai;
use App\Ekskursijos;
use App\Auto_nuomos;
use App\Sutartys;
use App\Sutartys_ekskursijos;
use App\Viesbuciai_keliones;
use App\Automobilis;
use DB;
use Auth;
use Redirect;
use Session;
use Datetime;
use Eloquent;
use Illuminate\Support\Facades\Input;
use Validator;

class PaslaugosController extends Controller
{
    //isveda visas kliento uzsakytas paslaugas
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
        return view('paslaugos.sutartiesPaslaugos', compact('ekskursijos', 'auto_nuomos', 'viesbutis', 'draudimas', 'sutartis'));
    }
    //uzsako viesbuti
    public function createViesbutis() 
    {
        $sutarties_nr = Session::get('sutartis')->nr;//i kuria sutarti irasyti viesbucio id

        $kelione = Sutartys::select('keliones_nr')//kokia kelione yra uzsisakes klientas
        ->where('sutartys.nr', '=', $sutarties_nr)
        ->first();
        //viesbuciai galimi tai kelionei
        $viesbuciai = Viesbuciai_keliones::select('viesbucio_id', 
        DB::raw('viesbuciai.pavadinimas as pavadinimas'), DB::raw('viesbuciai.reitingas as reitingas'),
        DB::raw('viesbuciai.paros_kaina as paros_kaina'), DB::raw('viesbuciai.adresas as adresas'),
        DB::raw('viesbuciai.telefono_nr as tel_nr'))
        ->join('viesbuciai', 'viesbuciai.id', '=', 'viesbuciai_keliones.viesbucio_id')
        ->where('keliones_nr', '=', $kelione->keliones_nr)
        ->get();

        return view('viesbuciai.uzsakyti', compact('viesbuciai', 'sutarties_nr', 'keliones_nr'));
    }

    public function storeViesbutis() 
    {
        $viesbutis = Input::get('viesbucio_id');
        $sutarties_nr = Session::get('sutartis')->nr;

        Sutartys::where('sutartys.nr', '=', $sutarties_nr)//iraso i kliento sutarti pasirinkto viesbucio id
        ->update(['viesbucio_id' => $viesbutis]);
        return redirect('/klientouzsakymai/'.$sutarties_nr);
    }

    public function createDraudimas() 
    {
        $sutarties_nr = Session::get('sutartis')->nr;

        $isvykimas = Sutartys::select(DB::raw('kelioniu_datos.isvykimo_data as isvykimas'))//kada klientas isvyksta
        ->join('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->where('sutartys.nr', '=', $sutarties_nr)
        ->first();

        $grizimas = Sutartys::select(DB::raw('kelioniu_datos.grizimo_data as grizimas'))//kada klientas grizta
        ->join('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->where('sutartys.nr', '=', $sutarties_nr)
        ->first();
        //isrenka draudimus, kurie galios keliones metu
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

        Sutartys::where('sutartys.nr', '=', $sutarties_nr)//i sutarti iraso draudmo id
        ->update(['draudimo_nr' => $draudimas]);
        return redirect('/klientouzsakymai/'.$sutarties_nr);
    }

    public function createEkskursija() 
    {
        $sutarties_nr = Session::get('sutartis')->nr;
        //paima pasirinkta keliones laika
        $sutarties_info = Sutartys::select(DB::raw('kelioniu_datos.isvykimo_data as isvykimas'), DB::raw('kelioniu_datos.grizimo_data as grizimas'),
        'sutartys.keliones_nr')
        ->join('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->where('sutartys.nr', '=', $sutarties_nr)
        ->first();
        //isrenka ekskursijas kurios priklauso pasirinktai kelionei
        //ir kurios vyks kliento pasirinktu laiku
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
        //iraso pasirinktas ekskursijas
        foreach($ekskursijos as $ekskursija) {
            Sutartys_ekskursijos::create(['sutarties_nr' => $sutarties_nr,
                                            'ekskursijos_nr' => $ekskursija]);
        }


        return redirect('/klientouzsakymai/'.$sutarties_nr);
    }

    public function createAutoNuoma() 
    {
        //isrenka automobilius, kurie nera isnuomoti
        $automobiliai = Automobilis::whereNull('auto_nuomos_id')->get();

        return view('autonuoma.uzsakyti', compact('automobiliai'));
    }

    public function storeAutoNuoma(Request $request) 
    {
        $sutarties_nr = Session::get('sutartis')->nr;
        //paima keliones laika
        $keliones_laikas = Sutartys::select(DB::raw('kelioniu_datos.isvykimo_data as isvykimas'), DB::raw('kelioniu_datos.grizimo_data as grizimas'))
        ->join('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->where('sutartys.nr', '=', $sutarties_nr)
        ->first();

        Eloquent::unguard();
        //ar auto nuomos laikas sutampa su keliones laiku
        $this->validate($request, [
            'pradzios_data' => 'required|after_or_equal:'.$keliones_laikas->isvykimas,
            'pabaigos_data' => 'required|before_or_equal:'.$keliones_laikas->grizimas,
            'automobilio_nr' => 'required'
        ],
        [
            'pradzios_data.after_or_equal' => 'Užsakyti nepavyko: nuomos pradžios data ankstesnė nei kelionės išvykimo data: ' .$keliones_laikas->isvykimas,
            'pabaigos_data.before_or_equal' => 'Užsakyti nepavyko: nuomos pabaigos data vėlesnė nei kelionės grįžimo data: ' .$keliones_laikas->grizimas,
            'automobilio_nr.required' => 'Pasirinkite automobilį'
        ]);

        $pradzios_data = new DateTime(Input::get('pradzios_data'));
        $pabaigos_data = new DateTime(Input::get('pabaigos_data'));
        //suskaiciuoja kiek dienu nuomosis
        $dienos = date_diff($pabaigos_data, $pradzios_data)->format("%d");
        //paima automobilio paros kaina
        $automobilio_nr = Input::get('automobilio_nr');
        $paros_kaina = Automobilis::select('paros_kaina')
        ->where('nr', '=', $automobilio_nr)
        ->first();
        //apskaiciuoja nuomos kaina
        $bendra_kaina = $dienos * $paros_kaina->paros_kaina;
        
        //sukuria nauja auto_nuomos irasa
        $auto_nuoma = Auto_nuomos::create(['sutarties_nr' => $sutarties_nr,
                            'pradzios_data' => $pradzios_data,
                            'pabaigos_data' => $pabaigos_data,
                            'bendra_kaina' => $bendra_kaina]);
        //i automobili iraso auto_nuomos id
        Automobilis::where('nr', '=', $automobilio_nr)
        ->update(['auto_nuomos_id' => $auto_nuoma->id]);

        return redirect('/klientouzsakymai/'.$sutarties_nr);
    }
}
