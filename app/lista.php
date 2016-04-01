<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class cancion extends Model{

	protected $table = 'cat_lista';

	protected $primaryKey = 'id_lista';
	protected $fillable = array('txt_cancion');

	public function listaDetalle(){
		$this->hasMany('lista_detalle')
	}
}


?>