<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class TblGenPersonaXGrupoPoblacional extends Model
{
	protected $table = 'tbl_gen_persona_x_grupo_poblacional';
	protected $primaryKey = 'id';
	public $timestamps = false;

	protected $casts = [
		'id_persona' => 'int',
		'id_grupo_poblacional' => 'int'
	];

	protected $fillable = [
		'id_persona',
		'id_grupo_poblacional'
	];

	public function tbl_gen_persona()
	{
		return $this->belongsTo(\App\Models\TblGenPersona::class, 'id_persona');
	}

	public function tbl_gen_grupo_poblacional()
	{
		return $this->belongsTo(\App\Models\TblGenGrupoPoblacional::class, 'id_grupo_poblacional');
	}
}
