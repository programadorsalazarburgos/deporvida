<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class TblGenDiscapacidad
 * 
 * @property int $id_discapacidad
 * @property string $descripcion
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_dv_persona_x_discapacidads
 *
 * @package App\Models
 */
class TblGenDiscapacidad extends Model
{
	protected $table = 'tbl_gen_discapacidad';
	protected $primaryKey = 'id_discapacidad';
	public $timestamps = false;

	protected $fillable = [
		'descripcion'
	];

	public function tbl_dv_persona_x_discapacidads()
	{
		return $this->hasMany(\App\Models\TblDvPersonaXDiscapacidad::class, 'id_discapacidad');
	}
}
