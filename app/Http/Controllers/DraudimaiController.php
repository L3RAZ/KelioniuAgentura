<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Draudimai;
use App\Draudimo_tipas;

class DraudimaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = $request->user()->id;
        $draudimas = Draudimai::Where('id',$id)->get();
        return view('draudimai.sarasas',compact('draudimai'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $draudimo_tipai = Draudimo_tipas::all(); 
        return view('draudimai.prideti', compact('draudimo_tipai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       
        $draudimas = new Draudimai;
        $draudimas->kaina = request('kaina');
        $draudimas->galioja_nuo= request('galioja_nuo');
        $draudimas->galioja_iki = request('galioja_iki');
        $draudimas->draudimo_imone = request('draudimo_imone');
        $draudimas->tipas = request('tipas');
        $draudimas->save();

        return redirect('/draudimai');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
