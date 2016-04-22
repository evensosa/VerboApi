<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\cancion;
use App\cancion_detalle;

class CancionesLetraDetalleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
        $column = 'id_cancion'; // This is the name of the column you wish to search
        $cancion_detalle = cancion_detalle::where($column , '=', $id)->get();
        return $cancion_detalle;

        if(!$cancion_detalle){
            return response()->json(['mensaje' => 'No se encuentra esa cancion','codigo' => 404]);
        }
        
        return response()->json(['datos' => $cancion_detalle],200);
        
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
    public function store(Request $request,$id_cancion)
    {
        $letra = $request->input('letra');

        $letra = explode(";",$letra);
        $consec = 1;
        $tipo = 2;
        
        $column = "id_cancion";
        cancion_detalle::where($column , '=', $id_cancion)->delete();
        
        foreach($letra as $verso){
            
            if(strpos($verso,'  ')!==false || strlen($verso) < 5 && strlen($verso) > 0){
                $tipo = 1;
            }
            elseif($verso==""){
                $tipo = 3;	
            }
            else{
                $tipo = 2;		
            }
            
            cancion_detalle::create(array(  'id_cancion' => $id_cancion,
                                'id_verso' => $consec,
                                'txt_verso' => $verso,
                                'tipo' => 2)    );
                                
            $consec++;                                
        }
        
        
        return "Cancion Guardada!";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$sn_tonos)
    {
        $column = 'id_cancion'; // This is the name of the column you wish to search
        
        if($sn_tonos == 1){
            
                  $cancion_detalle = cancion_detalle::where($column , '=', $id)->get(); 
                   
        }
        else{
            
                $cancion_detalle = cancion_detalle::where($column , '=', $id)
                                            ->where('tipo','<>',1)
                                            ->get();
                                                
        }
        

       

        if(!$cancion_detalle){
            return response()->json(['mensaje' => 'No se encuentra esa cancion','codigo' => 404]);
        }
        
        return response()->json(['datos' => $cancion_detalle],200);
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
    public function destroy($id_cancion)
    {
        
        $column = "id_cancion";
        cancion_detalle::where($column , '=', $id_cancion)->delete();

		return response()->json(['mensaje' => 'Letra eliminado'],200);
        
    }
}
