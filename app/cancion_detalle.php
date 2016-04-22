<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class cancion_detalle extends Model{

	public $timestamps = false;
	protected $table = 'cat_cancion_detalle';

	protected $fillable = array('id_cancion','id_verso','txt_verso','tipo');

	public function Cancion(){
		$this->belongsTo('cancion');
	}
	
	

}


?>