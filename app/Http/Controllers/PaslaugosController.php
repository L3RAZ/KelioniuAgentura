<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Draudimai;
use App\Ekskursijos;
use App\Auto_nuomos;
use App\Sutartys;
use App\Sutartys_ekskursijos;

class PaslaugosController extends Controller
{
    public function show($id)
    {
        $ekskursijos = Sutartys_ekskursijos::select()
        ->join('sutartys', 'sutartys_ekskursijos.sutarties_nr', '=', 'sutartys.nr')
        ->where('sutarties_nr', '=', $id)
        ->get();

        return view('paslaugos.sutartiesPaslaugos', compact('ekskursijos'));
    }
}
