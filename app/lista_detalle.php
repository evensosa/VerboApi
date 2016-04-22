<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class lista_detalle extends Model{

	public $timestamps = false;
	protected $table = 'cat_lista_detalle';

	protected $fillable = array('id_lista','id_cancion','tono','num_orden');

	public function Lista(){
		$this->belongsTo('lista');
	}

}


?>