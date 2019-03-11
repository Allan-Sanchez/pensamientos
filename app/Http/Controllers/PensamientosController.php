<?php

namespace App\Http\Controllers;

use App\Pensamiento as pensamientos;
use Illuminate\Http\Request;

class PensamientosController extends Controller
{

    function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return pensamientos::where('user_id',auth()->id())->get();
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
        
        $pensamiento = new pensamientos();
        $pensamiento->descripcion = $request->descripcion;
        $pensamiento ->user_id = auth()->id();
        $pensamiento->save();        
        
        return $pensamiento;
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
        $pensamiento = pensamientos::find($id);
        $pensamiento->descripcion =$request->descripcion;
        $pensamiento->save();   

        return $pensamiento;
        
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
        $pensamiento = pensamientos::find($id);
        $pensamiento->delete();  
    }
}
