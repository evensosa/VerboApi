<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class cancion extends Model{

	public $timestamps = false;
	protected $table = 'cat_cancion';

	protected $primaryKey = 'id_cancion';
	protected $fillable = array('txt_cancion','tono','tempo','link');

	public function cancionDetalles(){
		$this->hasMany('cancion_detalle');
	}
}


?>