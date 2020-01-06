<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medidor;

class MedidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $medidores = Medidor::get();
      return view('medidor.index', compact('medidores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Medidor::create($request->all());

      return redirect()->route('medidor.index')->with('success','Datos guardados correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $medidor = Medidor::find($id);
      return view('medidor.show', compact('medidor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return Medidor::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medidor $medidor)
    {
        $medidor->update($request->all());

        return redirect()->route('medidor.index')->with('success','Datos actualizados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $medidor = Medidor::find($id);

      $medidor->delete();

      return ['success' => 'Dato eliminado correctamente.'];
    }
}
