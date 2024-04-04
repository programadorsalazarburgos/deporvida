<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class TblGenParentesco
 * 
 * @property int $id_persona_parentesco
 * @property string $descripcion
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_dv_fichas
 *
 * @package App\Models
 */
class TblGenParentesco extends Model
{
	protected $table = 'tbl_gen_parentesco';
	protected $primaryKey = 'id_persona_parentesco';
	public $timestamps = false;

	protected $fillable = [
		'descripcion'
	];

	public function tbl_dv_fichas()
	{
		return $this->hasMany(\App\Models\TblDvFicha::class, 'id_persona_vive_con_parentesco');
	}
}
