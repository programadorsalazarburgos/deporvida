<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblGenEp
 * 
 * @property int $id_eps
 * @property string $descripcion
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_dv_fichas
 *
 * @package App\Models
 */
class TblGenEp extends Model
{
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $fillable = [
		'descripcion',
		'id_regimen',
		'activo'
	];

	public function tbl_dv_fichas()
	{
		return $this->hasMany(\App\Models\TblDvFicha::class, 'id_eps');
	}
}
