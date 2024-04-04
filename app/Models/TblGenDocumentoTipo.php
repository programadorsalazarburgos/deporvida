<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TblGenDocumentoTipo
 * 
 * @property int $id_documento_tipo
 * @property string $descripcion
 * @property string $descripcion_2
 * 
 * @property \Illuminate\Database\Eloquent\Collection $tbl_gen_personas
 *
 * @package App\Models
 */
class TblGenDocumentoTipo extends Model
{
	protected $table = 'tbl_gen_documento_tipo';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $fillable = [
		'descripcion',
		'descripcion_2'
	];

	public function tbl_gen_personas()
	{
		return $this->hasMany(\App\Models\TblGenPersona::class, 'id_documento_tipo');
	}
}
