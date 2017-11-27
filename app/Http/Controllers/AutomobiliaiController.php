<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Automobiliai;

class AutomobiliaiController extends Controller
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
        $automobilis = Automobiliai::Where('id',$id)->get();
        return view('automobiliai.sarasas',compact('automobiliai'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('automobiliai.prideti', compact('automobiliai'));
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
       // dd($request); 
        $automobilis = new Automobiliai;
        $automobilis->marke = request('marke');
        $automobilis->modelis= request('modelis');
        $automobilis->variklio_turis = request('variklio_turis');
        $automobilis->variklio_galia = request('variklio_galia');
        $automobilis->pagaminimo_metai = request('pagaminimo_metai');
        $automobilis->paros_kaina = request('paros_kaina');
        $automobilis->duru_sk = request('duru_sk');
        $automobilis->registracijos_nr= request('registracijos_nr');
        $automobilis->pavaru_deze = request('pavaru_deze');
        $automobilis->kebulo_tipas = request('kebulo_tipas');
        $automobilis->save();
         
        
        return redirect('/automobiliai');
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
