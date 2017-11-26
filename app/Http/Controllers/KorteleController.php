<?php

namespace App\Http\Controllers;

use App\Kortele;
use Illuminate\Http\Request;

class KorteleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->user()->id;
        $korteles = Kortele::Where('savininko_id',$id)->get();
        return view('korteles.sarasas',compact('korteles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('korteles.naujakortele');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        
        $kortele = new Kortele;
        $kortele->savininko_id = request('savininko_id');
        $kortele->saskaitos_nr = request('saskaitos_nr');
        $kortele->banko_pavadinimas = request('banko_pavadinimas');
        $kortele->korteles_nr = request('korteles_nr');
        $kortele->galiojimo_data = request('korteles_data1').'/'.request('korteles_data2');
        $kortele->cvv = request()->get('CVV');
        $kortele->korteles_tipas = request('korteles_tipas');
        $kortele->savininko_vardas = request('savininko_vardas');
        $kortele->savininko_pavarde = request('savininko_pavarde');
        $kortele->save();
        //dd($kortele);
        
        return redirect('/korteles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kortele  $kortele
     * @return \Illuminate\Http\Response
     */
    public function show(Kortele $kortele)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kortele  $kortele
     * @return \Illuminate\Http\Response
     */
    public function edit(Kortele $kortele)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kortele  $kortele
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kortele $kortele)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kortele  $kortele
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kortele $kortele)
    {
        $kortele->delete();
        return redirect('/korteles');
    }
}
