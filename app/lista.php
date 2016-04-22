<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class lista extends Model{

	public $timestamps = false;
	protected $table = 'cat_lista';

	protected $primaryKey = 'id_lista';
	protected $fillable = array('txt_lista');

	public function listaDetalle(){
		$this->hasMany('lista_detalle');
	}
}


?>