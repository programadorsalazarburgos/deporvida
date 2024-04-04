<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class TblGenGrupoPoblacional
 * 
 * @property int $id_grupo_social
 * @property string $descripcion
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_gen_persona_x_grupo_poblacionals
 *
 * @package App\Models
 */
class TblGenGrupoPoblacional extends Model
{
	protected $table = 'tbl_gen_grupo_poblacional';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $fillable = [
		'descripcion'
	];

	public function tbl_gen_persona_x_grupo_poblacionals()
	{
		return $this->hasMany(\App\Models\TblGenPersonaXGrupoPoblacional::class, 'id_grupo_poblacional');
	}
}
