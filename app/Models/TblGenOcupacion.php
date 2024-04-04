<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class TblGenOcupacion
 * 
 * @property int $id_ocupacion
 * @property string $descripcion
 * @property string $activo
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_dv_persona_x_ocupacions
 *
 * @package App\Models
 */
class TblGenOcupacion extends Model
{
	protected $table = 'tbl_gen_ocupacion';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $fillable = [
		'descripcion',
		'activo'
	];

	public function tbl_dv_persona_x_ocupacions()
	{
		return $this->hasMany(\App\Models\TblDvPersonaXOcupacion::class, 'id_ocupacion');
	}
}
