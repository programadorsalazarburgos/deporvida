<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class TblDvPersonaXOcupacion
 * 
 * @property int $tbl_persona_x_ocupacion
 * @property int $id_persona
 * @property int $id_ocupacion
 * 
 * @property \App\Models\TblGenPersona $tbl_gen_persona
 * @property \App\Models\TblGenOcupacion $tbl_gen_ocupacion
 *
 * @package App\Models
 */
class TblDvPersonaXOcupacion extends Model
{
	protected $table = 'tbl_dv_persona_x_ocupacion';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $casts = [
		'id_persona' => 'int',
		'id_ocupacion' => 'int'
	];

	protected $fillable = [
		'id_persona',
		'id_ocupacion'
	];

	public function tbl_gen_persona()
	{
		return $this->belongsTo(\App\Models\TblGenPersona::class, 'id_persona');
	}

	public function tbl_gen_ocupacion()
	{
		return $this->belongsTo(\App\Models\TblGenOcupacion::class, 'id_ocupacion');
	}
}
