<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sutartys;
use App\Kelioniu_datos;
use App\Viesbuciai_keliones;
use App\Ekskursijos;
use App\Auto_nuomos;
use DB;
use Eloquent;
use Session;
use Auth;
use Redirect;
use Illuminate\Support\Facades\Input;

class SutartysController extends Controller
{
    public function index()
    {
        return view('uzsakymai.pridetiUzsakyma');
    }

    public function create()
    {
        if(!Auth::check())
        return Redirect::to('/');

        $keliones_nr = Session::get('kelione')->id;
        $datos = Kelioniu_datos::where('keliones_nr', '=', $keliones_nr)
        ->where('laisvu_vietu_sk', '>', '1')
        ->get();

        /*$viesbuciai = Viesbuciai_keliones::select('viesbucio_id', 
                        DB::raw('viesbuciai.pavadinimas as pavadinimas'), DB::raw('viesbuciai.reitingas as reitingas'))
        ->join('viesbuciai', 'viesbuciai.id', '=', 'viesbuciai_keliones.viesbucio_id')
        ->where('keliones_nr', '=', $keliones_nr)
        ->get();*/

        return view('uzsakymai.pridetiUzsakyma', compact('datos'));//, 'viesbuciai'));
    }

    public function store() {
        Eloquent::unguard();

        $this->validate(request(), [
            'pasirinkta_data' => 'required',
            'vartotojo_id' => 'required',
            'keliones_nr' => 'required',
            //'viesbucio_id' => 'required',
            'sudarymo_data' => 'required',
            'yra_archyvuota' => 'required',
            'zmoniu_sk' => 'required'
        ],
        [
            'pasirinkta_data.required' => 'Būtina pasirinkti kelionės datą.',
            //'viesbucio_id.required' => 'Būtina pasirinkti viešbutį.',
            'zmoniu_sk.required' => 'Būtina nurodyti asmenų skaičių'
        ]);
        $sutartis = Sutartys::create(request(['yra_arhyvuota', 'vartotojo_id', 'keliones_nr', 'sudarymo_data', 'pasirinkta_data', 
        'bendra_kaina', 'busena', 'zmoniu_sk']));
        $pasirinkta_data = Input::get('pasirinkta_data');
        $zmoniu_sk = Input::get('zmoniu_sk');
        Kelioniu_datos::where('id', '=', $pasirinkta_data)
        ->decrement('laisvu_vietu_sk', $zmoniu_sk);

        //Session::put(['sutartis', $sutartis]);

        return redirect('/klientouzsakymai');
    }

    public function showkliento()
    {
        if(!Auth::check())
            return Redirect::to('/');
        //request()->user()->authorizeRoles(['Klientas','Darbuotojas']);

        $vartotojo_id = Auth::id();
        $sutartys = Sutartys::where('vartotojo_id', '=', $vartotojo_id)->get();
        foreach($sutartys as $sutartis){
            //keliones kaina
            //------------------------------------------------------------------------
            $zmoniu_sk = $sutartis->zmoniu_sk;
            $keliones_kaina = Sutartys::select(DB::raw('keliones.kaina as kaina'))
            ->join('keliones', 'sutartys.keliones_nr', '=', 'keliones.id')
            ->where('sutartys.nr', '=', $sutartis->nr)
            ->first();
            $visa_kel_kaina = $zmoniu_sk * $keliones_kaina->kaina;
            //------------------------------------------------------------------------

            //viesbucio kaina
            //------------------------------------------------------------------------
            if( $sutartis->viesbucio_id != NULL ){
                $keliones_dienos = Sutartys::select(DB::raw('datediff(kelioniu_datos.grizimo_data, kelioniu_datos.isvykimo_data) as dienos'))
                ->join('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
                ->where('sutartys.nr', '=', $sutartis->nr)
                ->first();
                $paros_kaina = Sutartys::select(DB::raw('viesbuciai.paros_kaina as paros_kaina'))
                ->join('viesbuciai', 'sutartys.viesbucio_id', '=', 'viesbuciai.id')
                ->where('sutartys.nr', '=', $sutartis->nr)
                ->first();
                $viesbucio_kaina = $keliones_dienos->dienos * $paros_kaina->paros_kaina * ($zmoniu_sk / 2);
            }
            else $viesbucio_kaina = 0;
            //------------------------------------------------------------------------

            //draudimo kaina
            //------------------------------------------------------------------------
            if( $sutartis->draudimo_nr != NULL ){
                $d_kaina = Sutartys::select('draudimai.kaina')
                ->join('draudimai', 'sutartys.draudimo_nr', '=', 'draudimai.nr')
                ->where('sutartys.nr', '=', $sutartis->nr)
                ->first();
                $draudimo_kaina = $d_kaina->kaina * $zmoniu_sk;
            }
            else $draudimo_kaina = 0;
            //------------------------------------------------------------------------

            //ekskursiju kaina
            //------------------------------------------------------------------------
            $ek_kaina = Sutartys::select(DB::raw('sum(ekskursijos.kaina) as kaina'))
            ->join('sutartys_ekskursijos', 'sutartys.nr', '=', 'sutartys_ekskursijos.sutarties_nr')
            ->join('ekskursijos', 'sutartys_ekskursijos.ekskursijos_nr', '=', 'ekskursijos.nr')
            ->where('sutartys.nr', '=', $sutartis->nr)
            ->first();

            if($ek_kaina->kaina != NULL)
                $ekskursiju_kaina = $ek_kaina->kaina * $zmoniu_sk;
            else $ekskursiju_kaina = 0;
            //------------------------------------------------------------------------

            //auto nuomos kaina
            //------------------------------------------------------------------------
            $aut_kaina = Sutartys::select(DB::raw('sum(auto_nuomos.bendra_kaina) as kaina'))
            ->join('auto_nuomos', 'sutartys.nr', '=', 'auto_nuomos.sutarties_nr')
            ->where('sutartys.nr', '=', $sutartis->nr)
            ->first();

            if($aut_kaina->kaina != NULL)
                $auto_nuomos_kaina = $aut_kaina->kaina;
            else $auto_nuomos_kaina = 0;
            //------------------------------------------------------------------------

            //bendra sutarties kaina
            //------------------------------------------------------------------------
            $bendra_kaina = $visa_kel_kaina + $viesbucio_kaina + $draudimo_kaina + $ekskursiju_kaina + $auto_nuomos_kaina;
                
            Sutartys::where('sutartys.nr', '=', $sutartis->nr)
            ->update(['bendra_kaina' => $bendra_kaina]);
            
            
        }

        $kliento_sutartys = Sutartys::select('sutartys.nr', 'sudarymo_data','sutartys.busena', DB::raw('sutarties_busena.busena as sut_busena'),
                            DB::raw('keliones.valstybe as valstybe'), DB::raw('miestas.pavadinimas as miestas'),
                            DB::raw('kelioniu_datos.isvykimo_data as isvykimas'),DB::raw('kelioniu_datos.grizimo_data as grizimas'), 
                            'zmoniu_sk', 'bendra_kaina', 'draudimo_nr')
                            ->join('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
                            ->join('sutarties_busena', 'sutartys.busena', '=', 'sutarties_busena.id')
                            ->join('keliones', 'sutartys.keliones_nr', '=', 'keliones.id')
                            ->join('miestas', 'miestas.kodas', '=', 'keliones.miesto_kodas')
                            ->where('vartotojo_id', '=', $vartotojo_id)
                            ->paginate(2);
        return view('uzsakymai.klientoUzsakymai', compact('kliento_sutartys'));
    }

    public static function getPaslaugos($sutarties_nr)
    {
        $ekskursijos = Ekskursijos::where('sutarties_nr', '=', $sutarties_nr)->get();
        $auto_nuomos = Auto_nuomos::where('sutarties_nr', '=', $sutarties_nr)->get();
        $draudimas = Sutartys::select(DB::raw('draudimai.*'))
        ->join('draudimai', 'sutartys.draudimo_nr', '=', 'draudimai.nr')
        ->join('draudimo_tipas', 'draudimai.tipas', '=', 'draudimo_tipas.id')
        ->where('sutartys.nr', '=', $sutarties_nr)
        ->first();

        return compact('ekskursijos');
    }

    public function update($id)
	{
        $sutartis= Sutartys::where('nr',$id)->first();
        if($sutartis != null)
        {
            Sutartys::where('nr',$id)->update(request(['busena']));
        }
        return Redirect::back();
    }

    public function rodytidarbuotojui()
    {
        if(!Auth::check())
        return Redirect::to('/');
        request()->user()->authorizeRoles(['Administratorius','Darbuotojas']);
        $sutartys = Sutartys::select('sutartys.nr','sutartys.busena', DB::raw('sutarties_busena.busena as sut_busena'),
        DB::raw('concat(users.name," ",users.surname) as uzsakovas'), DB::raw('miestas.pavadinimas as miestas'),
        DB::raw('concat("Nr. ",keliones.id," ,Šalis: ",keliones.valstybe," ,Miestas: ") as kelione'))
        ->join('sutarties_busena', 'sutartys.busena', '=', 'sutarties_busena.id')
        ->join('users', 'users.id', '=', 'sutartys.vartotojo_id')
        ->join('keliones', 'sutartys.keliones_nr', '=', 'keliones.id')
        ->join('miestas', 'miestas.kodas', '=', 'keliones.miesto_kodas')
        ->where('sutartys.busena','2')->orWhere('sutartys.busena','4')->get();
        return view('uzsakymai.laukiantyspatvirtinimo',compact('sutartys'));
    }

    public function archyvuoti($id)
    {

    }
}
