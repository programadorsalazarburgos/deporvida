<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class TblGenEscolaridadEstado
 * 
 * @property int $id
 * @property string $descripcion
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_dv_fichas
 *
 * @package App\Models
 */
class TblGenEscolaridadEstado extends Model
{
	protected $table = 'tbl_gen_escolaridad_estado';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $fillable = [
		'descripcion'
	];

	public function tbl_dv_fichas()
	{
		return $this->hasMany(\App\Models\TblDvFicha::class, 'id_escolaridad_estado');
	}
}
