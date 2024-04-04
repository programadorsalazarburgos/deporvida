<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class TblGenEtnium
 * 
 * @property int $id_etnia
 * @property string $descripcion
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_dv_fichas
 *
 * @package App\Models
 */
class TblGenEtnium extends Model
{
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $fillable = [
		'descripcion'
	];

	public function tbl_dv_fichas()
	{
		return $this->hasMany(\App\Models\TblDvFicha::class, 'id_etnia');
	}
}
