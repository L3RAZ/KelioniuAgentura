<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Viesbuciai;
use App\Miestas;

class ViesbuciaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = $request->user()->id;
        $viesbutis = Viesbuciai::Where('id',$id)->get();
        return view('viesbuciai.sarasas',compact('viesbuciai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $miestai = Miestas::all();
        return view('viesbuciai.prideti', compact('miestai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(request());
        $viesbutis = new Viesbuciai;
        $viesbutis->miesto_kodas = request('miesto_kodas');
        $viesbutis->pavadinimas= request('pavadinimas');
        $viesbutis->reitingas = request('reitingas');
        $viesbutis->paros_kaina = request('paros_kaina');
        $viesbutis->adresas = request('adresas');
        $viesbutis->telefono_nr = request('telefono_nr');
        $viesbutis->save();
       // dd($viesbutis); 
        
        return redirect('/viesbuciai');
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
