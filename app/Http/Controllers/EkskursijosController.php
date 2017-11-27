<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ekskursijos;
use App\Kelione;
use App\Miestas;

class EkskursijosController extends Controller
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
        $ekskursija = Ekskursijos::Where('id',$id)->get();
        return view('ekskursijos.sarasas',compact('ekskursijos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $keliones = Kelione::all(); 
        return view('ekskursijos.prideti', compact('keliones', 'miestai'));
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
      
        $ekskursija = new Ekskursijos;
        $ekskursija->keliones_nr = request('keliones_nr');
        $ekskursija->isvykimo_data= request('isvykimo_data');
        $ekskursija->grizimo_data = request('grizimo_data');
        $ekskursija->vieta = request('vieta');
        $ekskursija->kaina = request('kaina');
        $ekskursija->gidas = request('gidas');
        $ekskursija->save();
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
