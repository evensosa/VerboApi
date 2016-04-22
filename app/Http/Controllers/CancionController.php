<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\cancion;
use App\cancion_detalle;

class CancionController extends Controller
{

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['datos' => cancion::all()],200);
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'mostrar formulario crear';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if(!$request->input('txt_cancion'))
		{
			return response()->json(['mensaje' => 'No se pudieron procesar los valores', 'codigo' => 422],422);
		}
		$cancion = cancion::create($request->all());
        
        $id_cancion = $cancion->id_cancion;

        cancion_detalle::create(array(  'id_cancion' => $id_cancion,
                                        'id_verso' => 1,
                                        'txt_verso' => 'Letra Aqui',
                                        'tipo' => 2)    );
        
		return response()->json(['mensaje' => 'Cancion insertada!'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        

        if(is_numeric($id)){
            $cancion = cancion::find("$id");
        }
        else{
            $column = 'txt_cancion'; // This is the name of the column you wish to search
            $cancion = cancion::where($column , 'like', '%'.$id.'%')->get();
            return $cancion;
        }

        if(!$cancion){
            return response()->json(['mensaje' => 'No se encuentra esa cancion','codigo' => 404]);
        }
        
        
        return response()->json(['datos' => $cancion],200);
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
        $metodo = $request->method();
        $cancion = cancion::find($id);
        
        if(!$cancion){
            return response()->json(['mensaje' => 'No se encuentra este fabricante', 'codigo' => 404],404);
        }
        
        $txt_cancion = $request->input('txt_cancion');
        $tono = $request->input('tono');
        $tempo = $request->input('tempo');
        $link = $request->input('link');
        
        if($metodo === 'PATCH'){
            
            $sn_editado = false;
            
            if($txt_cancion != null && $txt_cancion != ''){
                $cancion->txt_cancion = $txt_cancion;
                $sn_editado = true;
            }
            
            if($tono != null && $tono != ''){
                $cancion->tono = $tono;
                $sn_editado = true;
            }
            
            if($tempo != null && $tempo != ''){
                $cancion->tempo = $tempo;
                $sn_editado = true;
            }
            
            if($link != null && $link != ''){
                $cancion->link = $link;
                $sn_editado = true;
            }    
            
            if($sn_editado){
                $cancion->save();
                return response()->json(['mensaje' => 'Cancion editada'],200);
            }             
            
            return response()->json(['mensaje' => 'No se modificó ningun fabricante'],200);                   
            
        }
        
       if(!$txt_cancion || !$tempo || !$link || !$tono){
            return response()->json(['mensaje' => 'No se pudieron procesar los valores', 'codigo' => 422],422);
        }
        
        $cancion->txt_cancion = $txt_cancion;
        $cancion->tono = $tono;
        $cancion->tempo = $tempo;
        $cancion->link = $link;
        
        $cancion->save();
        
        return response()->json(['mensaje' => 'Cancion editada'],200);
        
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
