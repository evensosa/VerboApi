<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class cancion extends Model{

	protected $table = 'cat_lista_detalle';

	protected $fillable = array('id_lista','id_cancion');

	public function Lista(){
		$this->belongsTo('lista');
	}

}


?>