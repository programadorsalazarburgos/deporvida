<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 20 Jan 2018 05:19:45 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblDvPersonaXDiscapacidad extends Model
{
	protected $table = 'tbl_dv_persona_x_discapacidad';
	protected $primaryKey = 'id_persona_x_discapacidad';
	public $timestamps = false;

	protected $casts = [
		'id_persona' => 'int',
		'id_discapacidad' => 'int'
	];

	protected $fillable = [
		'id_persona',
		'id_discapacidad'
	];

	public function tbl_gen_persona()
	{
		return $this->belongsTo(\App\Models\TblGenPersona::class, 'id_persona');
	}

	public function tbl_gen_discapacidad()
	{
		return $this->belongsTo(\App\Models\TblGenDiscapacidad::class, 'id_discapacidad');
	}
}
