<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sutartys;
use App\Kelione;
use DB;
use Illuminate\Support\Facades\Input;

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

    public function neapmoketos()
    {
        $ataskaita = Sutartys::leftJoin('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->leftJoin('sutarties_busena', 'sutartys.busena', '=', 'sutarties_busena.id')
        ->leftJoin('users', 'sutartys.vartotojo_id', '=', 'users.id')
        ->where('sutartys.busena', '!=', '3')
        ->where('sutartys.busena', '!=', '5')
        ->whereDate('kelioniu_datos.isvykimo_data', '<', date('Y-m-d'))
        ->orderBy('sutartys.nr')
        ->get();

        return view('ataskaitos.neapmoketosSutartys', compact('ataskaita'));
    }

    public function vidutinesKainos()
    {
        $ataskaita = Kelione::select('valstybe', DB::raw('ROUND(AVG(keliones.kaina), 2) as kaina'))
        ->groupBy('valstybe')
        ->orderBy('valstybe', 'asc')
        ->get();

        return view('ataskaitos.vidutinesKainos', compact('ataskaita'));
    }

    public function tipaipaslaugos()
    {
        $poilsine = Sutartys::select(DB::raw('keliones.tipas'),
        DB::raw('SUM(ekskursijos.kaina * zmoniu_sk) as eksk_kaina'),
        DB::raw('SUM(draudimai.kaina * zmoniu_sk) as draud_kaina'),
        DB::raw('SUM(auto_nuomos.bendra_kaina) as auto_kaina'),
        DB::raw('SUM(viesbuciai.paros_kaina * datediff(kelioniu_datos.grizimo_data, kelioniu_datos.isvykimo_data) * (zmoniu_sk / 2)) as vies_kaina'))
        ->leftJoin('sutartys_ekskursijos', 'sutartys.nr', '=', 'sutartys_ekskursijos.sutarties_nr')
        ->leftJoin('ekskursijos', 'sutartys_ekskursijos.ekskursijos_nr', '=', 'ekskursijos.nr')
        ->leftJoin('keliones', 'sutartys.keliones_nr', '=', 'keliones.id')
        ->leftJoin('draudimai', 'sutartys.draudimo_nr', '=', 'draudimai.nr')
        ->leftJoin('auto_nuomos', 'auto_nuomos.sutarties_nr', '=', 'sutartys.nr')
        ->leftJoin('viesbuciai', 'sutartys.viesbucio_id', '=', 'viesbuciai.id')
        ->leftJoin('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->where('keliones.tipas', '=', '1')
        ->groupBy('keliones.tipas')
        ->get();

        $pazintine = Sutartys::select(DB::raw('keliones.tipas'),
        DB::raw('SUM(ekskursijos.kaina * zmoniu_sk) as eksk_kaina'),
        DB::raw('SUM(draudimai.kaina * zmoniu_sk) as draud_kaina'),
        DB::raw('SUM(auto_nuomos.bendra_kaina) as auto_kaina'),
        DB::raw('SUM(viesbuciai.paros_kaina * datediff(kelioniu_datos.grizimo_data, kelioniu_datos.isvykimo_data) * (zmoniu_sk / 2)) as vies_kaina'))
        ->leftJoin('sutartys_ekskursijos', 'sutartys.nr', '=', 'sutartys_ekskursijos.sutarties_nr')
        ->leftJoin('ekskursijos', 'sutartys_ekskursijos.ekskursijos_nr', '=', 'ekskursijos.nr')
        ->leftJoin('keliones', 'sutartys.keliones_nr', '=', 'keliones.id')
        ->leftJoin('draudimai', 'sutartys.draudimo_nr', '=', 'draudimai.nr')
        ->leftJoin('auto_nuomos', 'auto_nuomos.sutarties_nr', '=', 'sutartys.nr')
        ->leftJoin('viesbuciai', 'sutartys.viesbucio_id', '=', 'viesbuciai.id')
        ->leftJoin('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->where('keliones.tipas', '=', '2')
        ->groupBy('keliones.tipas')
        ->get();

        $aktyvi = Sutartys::select(DB::raw('keliones.tipas'),
        DB::raw('SUM(ekskursijos.kaina * zmoniu_sk) as eksk_kaina'),
        DB::raw('SUM(draudimai.kaina * zmoniu_sk) as draud_kaina'),
        DB::raw('SUM(auto_nuomos.bendra_kaina) as auto_kaina'),
        DB::raw('SUM(viesbuciai.paros_kaina * datediff(kelioniu_datos.grizimo_data, kelioniu_datos.isvykimo_data) * (zmoniu_sk / 2)) as vies_kaina'))
        ->leftJoin('sutartys_ekskursijos', 'sutartys.nr', '=', 'sutartys_ekskursijos.sutarties_nr')
        ->leftJoin('ekskursijos', 'sutartys_ekskursijos.ekskursijos_nr', '=', 'ekskursijos.nr')
        ->leftJoin('keliones', 'sutartys.keliones_nr', '=', 'keliones.id')
        ->leftJoin('draudimai', 'sutartys.draudimo_nr', '=', 'draudimai.nr')
        ->leftJoin('auto_nuomos', 'auto_nuomos.sutarties_nr', '=', 'sutartys.nr')
        ->leftJoin('viesbuciai', 'sutartys.viesbucio_id', '=', 'viesbuciai.id')
        ->leftJoin('kelioniu_datos', 'sutartys.pasirinkta_data', '=', 'kelioniu_datos.id')
        ->where('keliones.tipas', '=', '3')
        ->groupBy('keliones.tipas')
        ->get();

        return view('ataskaitos.tipaiPaslaugos', compact('poilsine', 'pazintine', 'aktyvi'));
    }

    public function bendrakainacreate()
    {
        return view('ataskaitos.bendraKaina');
    }

    public function bendrakainastore()
    {
        $data = [
            'pradzia' => Input::get('pradzios_data'),
            'pabaiga' => Input::get('pabaigos_data')
        ];
        

        $ataskaita = Sutartys::select(DB::raw('SUM(bendra_kaina) as suma'))
        ->whereBetween('sudarymo_data', $data)
        ->first();

        return view('ataskaitos.bendraKaina', compact('ataskaita'));
    }
}
